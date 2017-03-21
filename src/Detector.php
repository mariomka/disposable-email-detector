<?php

namespace Mariomka\DisposableEmailDetector;

class Detector
{
    /**
     * @var array
     */
    protected $domainList;

    /**
     * @var array
     */
    protected $wildcardDomainList;

    /**
     * Checks if an email is disposable.
     *
     * @param string $email
     *
     * @return bool
     * @throws NotValidEmailException
     */
    public function isDisposable(string $email) : bool
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new NotValidEmailException();
        }

        return $this->testDomain($email) || $this->testWildcardDomain($email);
    }

    /**
     * Test if domain are listed
     *
     * @param $email
     *
     * @return bool
     */
    protected function testDomain($email) {
        return array_search($this->domain($email), $this->domainList()) !== false;
    }

    /**
     * Test if wildcard domain are listed
     *
     * @param $email
     *
     * @return bool
     */
    protected function testWildcardDomain($email) {
        return preg_match('#@.+(\.[^\.]+){2,}$#', $email) &&
               array_search($this->wildcardDomain($email), $this->wildcardDomainList()) !== false;
    }

    /**
     * Get domain from an email.
     *
     * @param string $email
     *
     * @return string
     */
    protected function domain(string $email) : string
    {
        return strtolower(substr(strrchr($email, '@'), 1));
    }

    /**
     * Get wildcard domain from an email.
     *
     * @param string $email
     *
     * @return string
     */
    protected function wildcardDomain(string $email) : string
    {
        return strtolower(preg_replace('#^.+@.+\.([^\.]+\.[^\.]+)$#', '$1', $email));
    }

    /**
     * Get a domain list.
     *
     * @return array
     */
    protected function domainList() : array
    {
        if (!$this->domainList) {
            $this->domainList = json_decode(file_get_contents(__DIR__ . '/../disposable-email-domains/index.json'));
        }

        return $this->domainList;
    }

    /**
     * Get a wildcard domain list.
     *
     * @return array
     */
    protected function wildcardDomainList() : array
    {
        if (!$this->wildcardDomainList) {
            $this->wildcardDomainList = json_decode(file_get_contents(__DIR__ . '/../disposable-email-domains/wildcard.json'));
        }

        return $this->wildcardDomainList;
    }
}

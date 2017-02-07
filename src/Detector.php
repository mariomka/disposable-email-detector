<?php

namespace Mariomka\DisposableEmailDetector;

class Detector
{
    /**
     * @var array
     */
    protected $domainList;

    /**
     * Checks if an email if disposable.
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

        return array_search($this->getDomain($email), $this->getDomainList()) !== false;
    }

    /**
     * Get domain from an email.
     *
     * @param string $email
     *
     * @return string
     */
    protected function getDomain(string $email) : string
    {
        return strtolower(substr(strrchr($email, '@'), 1));
    }

    /**
     * Get a domain list.
     *
     * @return array
     */
    protected function getDomainList() : array
    {
        if (!$this->domainList) {
            $this->domainList = json_decode(file_get_contents(__DIR__ . '/../domain-list.json'));
        }

        return $this->domainList;
    }
}

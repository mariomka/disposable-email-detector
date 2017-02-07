<?php

namespace Mariomka\DetectDisposableEmails\Test;

use Mariomka\DetectDisposableEmails\EmailDetector;
use Mariomka\DetectDisposableEmails\NotValidEmailException;

class EmailDetectorTest extends TestCase
{
    /**
     * @var EmailDetector
     */
    protected $emailDetector;

    protected function setUp()
    {
        parent::setUp();

        $this->emailDetector = new EmailDetector();
    }

    /** @test */
    function it_detect_a_disposable_emails()
    {
        $this->assertTrue($this->emailDetector->isDisposable('alice@mailinator.com'));
        $this->assertTrue($this->emailDetector->isDisposable('john@MAILINATOR.com'));
        $this->assertTrue($this->emailDetector->isDisposable('mary@temp-MAIL.com'));
    }

    /** @test */
    function it_detect_an_acceptable_email()
    {
        $this->assertFalse($this->emailDetector->isDisposable('alice@gmail.com'));
    }

    /** @test */
    function it_throws_an_exception_if_email_is_not_valid()
    {
        $this->expectException(NotValidEmailException::class);
        $this->emailDetector->isDisposable('not-valid-email');
    }
}

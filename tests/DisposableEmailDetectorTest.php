<?php

namespace Mariomka\DetectDisposableEmails\Test;

use Mariomka\DetectDisposableEmails\DisposableEmailDetector;
use Mariomka\DetectDisposableEmails\NotValidEmailException;

class DisposableEmailDetectorTest extends TestCase
{
    /**
     * @var DisposableEmailDetector
     */
    protected $disposableEmailDetector;

    protected function setUp()
    {
        parent::setUp();

        $this->disposableEmailDetector = new DisposableEmailDetector();
    }

    /** @test */
    function it_detect_a_disposable_emails()
    {
        $this->assertTrue($this->disposableEmailDetector->isDisposable('alice@mailinator.com'));
        $this->assertTrue($this->disposableEmailDetector->isDisposable('john@MAILINATOR.com'));
        $this->assertTrue($this->disposableEmailDetector->isDisposable('mary@temp-MAIL.com'));
    }

    /** @test */
    function it_detect_an_acceptable_email()
    {
        $this->assertFalse($this->disposableEmailDetector->isDisposable('alice@gmail.com'));
    }

    /** @test */
    function it_throws_an_exception_if_email_is_not_valid()
    {
        $this->expectException(NotValidEmailException::class);
        $this->disposableEmailDetector->isDisposable('not-valid-email');
    }
}

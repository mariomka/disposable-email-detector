<?php

namespace Mariomka\DisposableEmailDetector\Test;

use Mariomka\DisposableEmailDetector\Detector;
use Mariomka\DisposableEmailDetector\NotValidEmailException;

class DetectorTest extends TestCase
{
    /**
     * @var Detector
     */
    protected $detector;

    protected function setUp()
    {
        parent::setUp();

        $this->detector = new Detector();
    }

    /** @test */
    function it_detect_a_disposable_emails()
    {
        $this->assertTrue($this->detector->isDisposable('alice@mailinator.com'));
        $this->assertTrue($this->detector->isDisposable('john@MAILINATOR.com'));
        $this->assertTrue($this->detector->isDisposable('mary@temp-MAIL.com'));
    }

    /** @test */
    function it_detect_an_acceptable_email()
    {
        $this->assertFalse($this->detector->isDisposable('alice@gmail.com'));
    }

    /** @test */
    function it_throws_an_exception_if_email_is_not_valid()
    {
        $this->expectException(NotValidEmailException::class);
        $this->detector->isDisposable('not-valid-email');
    }
}
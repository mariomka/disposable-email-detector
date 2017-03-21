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
    public function it_detect_a_disposable_emails()
    {
        $this->assertTrue($this->detector->isDisposable('alice@mailinator.com'));
        $this->assertTrue($this->detector->isDisposable('john@MAILINATOR.com'));
        $this->assertTrue($this->detector->isDisposable('mary@temp-MAIL.com'));
    }

    /** @test */
    public function it_detect_a_disposable_wildcard_emails()
    {
        $this->assertTrue($this->detector->isDisposable('anything@alice.dropmail.me'));
        $this->assertTrue($this->detector->isDisposable('john.silv@sub.sub.sub.domain.33MAIL.com'));
        $this->assertTrue($this->detector->isDisposable('john@anything.dbo.kr'));
    }

    /** @test */
    public function it_detect_an_acceptable_email()
    {
        $this->assertFalse($this->detector->isDisposable('alice@gmail.com'));
        $this->assertFalse($this->detector->isDisposable('mary.ken@sub.domain.com'));
    }

    /** @test */
    public function it_throws_an_exception_if_email_is_not_valid()
    {
        $this->expectException(NotValidEmailException::class);
        $this->detector->isDisposable('not-valid-email');
    }
}

<?php

namespace PishroPayamak\Sms\Tests;

use Orchestra\Testbench\TestCase;
use PishroPayamak\Sms\SmsService;
use PishroPayamak\Sms\PishroPayamakServiceProvider;

class SmsServiceTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [PishroPayamakServiceProvider::class];
    }

    public function test_sms_service_can_be_resolved()
    {
        $service = app(SmsService::class);
        $this->assertInstanceOf(SmsService::class, $service);
    }
}
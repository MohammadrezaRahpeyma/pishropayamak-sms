<?php

namespace PishroPayamak\Sms\Facades;

use Illuminate\Support\Facades\Facade;

class PishroPayamak extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'pishropayamak.sms';
    }
}
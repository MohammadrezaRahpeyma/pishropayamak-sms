<?php

namespace PishroPayamak\Sms;

use Illuminate\Support\ServiceProvider;

class PishroPayamakServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/pishropayamak.php', 'pishropayamak');

        $this->app->singleton(SmsService::class, function ($app) {
            $token = config('pishropayamak.token');
            $baseUrl = config('pishropayamak.base_url', 'https://api-payamak.com/api/v3/rest');
            return new SmsService($token, $baseUrl);
        });

        $this->app->alias(SmsService::class, 'pishropayamak.sms');
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/pishropayamak.php' => config_path('pishropayamak.php'),
            ], 'pishropayamak-config');
        }
    }
}
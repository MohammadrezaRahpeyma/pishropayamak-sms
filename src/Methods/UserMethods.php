<?php

namespace PishroPayamak\Sms\Methods;

trait UserMethods
{
    /**
     * دریافت اعتبار باقی‌مانده کاربر (ریال)
     */
    public function getCredit(): array
    {
        return $this->sendRequest('/my/credit', []);
    }

    /**
     * دریافت اطلاعات کامل کاربر
     */
    public function getUserDetails(): array
    {
        return $this->sendRequest('/my', []);
    }

    /**
     * ثبت‌نام کاربر جدید
     */
    public function registerUser(
        string $username,
        string $password,
        string $passwordRepeat,
        string $parent,
        string $mobile,
        string $nationalCode,
        int $package,
        int $isReseller
    ): array {
        return $this->sendRequest('/user/register', [
            'uname' => $username,
            'passwd' => $password,
            'passwd_repeat' => $passwordRepeat,
            'parent' => $parent,
            'mobile' => $mobile,
            'melli_code' => $nationalCode,
            'package' => $package,
            'reseller' => $isReseller
        ]);
    }
}
<?php

namespace PishroPayamak\Sms;

use PishroPayamak\Sms\Methods\SmsMethods;
use PishroPayamak\Sms\Methods\UserMethods;
use PishroPayamak\Sms\Methods\PhonebookMethods;
use PishroPayamak\Sms\Methods\BlockedMethods;
use PishroPayamak\Sms\Exceptions\AuthenticationException;
use PishroPayamak\Sms\Exceptions\ValidationException;
use PishroPayamak\Sms\Exceptions\SmsException;

class SmsService
{
    use SmsMethods, UserMethods, PhonebookMethods, BlockedMethods;

    private string $token;
    private string $baseUrl;
    private int $timeout;

    public function __construct(string $token, ?string $baseUrl = null)
    {
        if (empty($token)) {
            throw new ValidationException('توکن نمی‌تواند خالی باشد');
        }

        $this->token = $token;
        $this->baseUrl = $baseUrl ?? 'https://api-payamak.com/api/v3/rest';
        $this->timeout = 30;
    }

    /**
     * ارسال درخواست به وب سرویس
     */
    private function sendRequest(string $endpoint, array $data, string $method = 'POST'): array
    {
        $url = $this->baseUrl . $endpoint;

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => $this->timeout,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => json_encode($data, JSON_UNESCAPED_UNICODE),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $this->token,
                'Token: ' . $this->token
            ],
            CURLOPT_SSL_VERIFYPEER => true,
        ]);

        $response = curl_exec($ch);
        $error = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($error) {
            throw new SmsException('خطای شبکه: ' . $error);
        }

        $result = json_decode($response, true);

        if (!$result) {
            throw new SmsException('پاسخ سرور معتبر نیست');
        }

        // بررسی خطاهای احراز هویت
        if ($httpCode === 401 || ($result['return']['status'] ?? 0) === 401) {
            throw new AuthenticationException('توکن نامعتبر یا منقضی شده است');
        }

        // بررسی وضعیت موفقیت
        $status = $result['return']['status'] ?? $result['status'] ?? 0;
        if ($status !== 200 && $status !== 0) {
            $message = $result['return']['message'] ?? $result['message'] ?? 'خطای ناشناخته';
            throw new SmsException('کد خطا: ' . $status . ' - ' . $message);
        }

        return $result;
    }

    /**
     * دریافت نمونه برای استفاده ساده
     */
    public static function make(string $token): self
    {
        return new self($token);
    }
}
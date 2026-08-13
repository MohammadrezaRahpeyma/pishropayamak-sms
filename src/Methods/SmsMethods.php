<?php

namespace PishroPayamak\Sms\Methods;

trait SmsMethods
{
    /**
     * ارسال پیامک به یک یا چند گیرنده
     */
    public function sendSms(string $from, array $recipients, string $message, int $type = 0): array
    {
        return $this->sendRequest('/sms/send', [
            'from' => $from,
            'recipients' => $recipients,
            'message' => $message,
            'type' => $type
        ]);
    }

    /**
     * ارسال گروهی (چند پیام متفاوت به گیرنده‌های مختلف)
     */
    public function sendMultiple(array $fromArray, array $recipients, array $messageArray, array $typeArray): array
    {
        return $this->sendRequest('/sms/multiple-send', [
            'fromArray' => $fromArray,
            'recipients' => $recipients,
            'messageArray' => $messageArray,
            'typeArray' => $typeArray
        ]);
    }

    /**
     * کنترل وضعیت پیامک (حداکثر ۵۰ شناسه)
     */
    public function getStatus(array $messageIds): array
    {
        return $this->sendRequest('/sms/status', [
            'messageid' => $messageIds
        ]);
    }

    /**
     * جزئیات پیامک (مشابه Status با اطلاعات کامل‌تر)
     */
    public function getSelect(array $messageIds): array
    {
        return $this->sendRequest('/sms/select', [
            'messageid' => $messageIds
        ]);
    }

    /**
     * لیست ارسال‌ها در بازه زمانی
     */
    public function getOutbox(int $startDate, int $endDate): array
    {
        return $this->sendRequest('/sms/selectoutbox', [
            'startdate' => $startDate,
            'enddate' => $endDate
        ]);
    }

    /**
     * آخرین وضعیت پیام (آخرین رکورد بر اساس شناسه)
     */
    public function getLatest(): array
    {
        return $this->sendRequest('/sms/latest', []);
    }

    /**
     * آخرین ارسال‌ها (حداکثر ۲۰۰ مورد)
     */
    public function getLatestOutbox(int $pageSize = 200): array
    {
        return $this->sendRequest('/sms/latestoutbox', [
            'pagesize' => $pageSize
        ]);
    }

    /**
     * تعداد ارسال‌ها در بازه زمانی
     */
    public function countOutbox(int $startDate, int $endDate): array
    {
        return $this->sendRequest('/sms/countoutbox', [
            'startdate' => $startDate,
            'enddate' => $endDate
        ]);
    }

    /**
     * تعداد دریافت‌ها در بازه زمانی
     */
    public function countInbox(int $startDate, int $endDate, ?string $number = null, ?int $isRead = null): array
    {
        $params = [
            'startdate' => $startDate,
            'enddate' => $endDate
        ];
        if ($number) $params['number'] = $number;
        if ($isRead !== null) $params['isread'] = $isRead;

        return $this->sendRequest('/sms/countinbox', $params);
    }

    /**
     * دریافت پیام‌های دریافتی کاربر
     */
    public function getInbox(int $count = 50, int $offset = 0): array
    {
        return $this->sendRequest('/sms/inbox', [
            'count' => $count,
            'offset' => $offset
        ]);
    }

    /**
     * دریافت پیام‌های دریافتی با صفحه‌بندی
     */
    public function getInboxPaged(?string $number = null, ?int $isRead = null, int $page = 1, int $pageSize = 200): array
    {
        $params = ['page' => $page, 'pagesize' => $pageSize];
        if ($number) $params['number'] = $number;
        if ($isRead !== null) $params['isread'] = $isRead;

        return $this->sendRequest('/sms/inboxpaged', $params);
    }

    /**
     * دریافت پیام‌های خوانده‌نشده و بروزرسانی خودکار
     */
    public function receive(?string $number = null, int $isRead = 0): array
    {
        $params = ['isread' => $isRead];
        if ($number) $params['number'] = $number;

        return $this->sendRequest('/sms/receive', $params);
    }

    /**
     * وضعیت پیام‌های ارسال شده به یک شماره خاص
     */
    public function getStatusByNumber(string $number, int $startDate, int $pageSize = 50): array
    {
        return $this->sendRequest('/sms/statusbynumber', [
            'number' => $number,
            'startdate' => $startDate,
            'pagesize' => $pageSize
        ]);
    }
}
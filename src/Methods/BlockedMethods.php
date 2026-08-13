<?php

namespace PishroPayamak\Sms\Methods;

trait BlockedMethods
{
    /**
     * دریافت لیست شماره‌های مسدود شده
     */
    public function getBlockedList(string $number, ?int $startDate = null, int $page = 1, int $pageSize = 200): array
    {
        $params = ['number' => $number, 'page' => $page, 'pagesize' => $pageSize];
        if ($startDate) $params['startdate'] = $startDate;

        return $this->sendRequest('/line/blocked/list', $params);
    }

    /**
     * افزودن شماره به لیست سیاه
     */
    public function addToBlocked(string $number, array $targets): array
    {
        return $this->sendRequest('/line/blocked/add', [
            'number' => $number,
            'to' => $targets
        ]);
    }

    /**
     * حذف شماره از لیست سیاه
     */
    public function removeFromBlocked(string $number, string $target): array
    {
        return $this->sendRequest('/line/blocked/remove', [
            'number' => $number,
            'to' => $target
        ]);
    }

    /**
     * بررسی وجود شماره در لیست سیاه
     */
    public function isBlocked(string $number, array $targets): array
    {
        return $this->sendRequest('/line/blocked/exists', [
            'number' => $number,
            'to' => $targets
        ]);
    }
}
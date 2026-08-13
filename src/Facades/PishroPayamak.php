<?php

namespace PishroPayamak\Sms\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static array sendSms(string $from, array $recipients, string $message, int $type = 0)
 * @method static array sendMultiple(array $fromArray, array $recipients, array $messageArray, array $typeArray)
 * @method static array getStatus(array $messageIds)
 * @method static array getSelect(array $messageIds)
 * @method static array getOutbox(int $startDate, int $endDate)
 * @method static array getLatest()
 * @method static array getLatestOutbox(int $pageSize = 200)
 * @method static array countOutbox(int $startDate, int $endDate)
 * @method static array countInbox(int $startDate, int $endDate, ?string $number = null, ?int $isRead = null)
 * @method static array getInbox(int $count = 50, int $offset = 0)
 * @method static array getInboxPaged(?string $number = null, ?int $isRead = null, int $page = 1, int $pageSize = 200)
 * @method static array receive(?string $number = null, int $isRead = 0)
 * @method static array getStatusByNumber(string $number, int $startDate, int $pageSize = 50)
 * @method static array getCredit()
 * @method static array getUserDetails()
 * @method static array registerUser(string $username, string $password, string $passwordRepeat, string $parent, string $mobile, string $nationalCode, int $package, int $isReseller)
 * @method static array getPhonebooks(?string $name = null)
 * @method static array getPhonebookNumbers(int $bookId)
 * @method static array createPhonebook(string $name, array $numbers, string $flag)
 * @method static array deletePhonebook(int $bookId)
 * @method static array addToPhonebook(int $bookId, array $numbers, ?string $flag = null)
 * @method static array removeFromPhonebook(int $bookId, array $numbers, ?string $flag = null)
 * @method static array getBlockedList(string $number, ?int $startDate = null, int $page = 1, int $pageSize = 200)
 * @method static array addToBlocked(string $number, array $targets)
 * @method static array removeFromBlocked(string $number, string $target)
 * @method static array isBlocked(string $number, array $targets)
 */
class PishroPayamak extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'pishropayamak.sms';
    }
}
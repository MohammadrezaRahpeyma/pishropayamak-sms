📱 مستندات کامل پکیج رسمی پیشرو پیامک برای لاراول (نسخه ۲.۰.۰)

پکیج رسمی پیشرو پیامک برای ارسال آسان و حرفه‌ای پیامک در پروژه‌های لاراول. این پکیج با پشتیبانی از وب سرویس REST نسخه ۳، امکانات کامل ارسال، دریافت، وضعیت‌یابی، مدیریت دفترچه تلفن و لیست سیاه را در اختیار شما قرار می‌دهد.
✨ ویژگی‌های کلیدی

    احراز هویت امن با توکن به جای نام کاربری و رمز عبور

    ارسال پیامک ساده و گروهی (چند پیام متفاوت)

    دریافت وضعیت و جزئیات پیام‌های ارسال شده

    دریافت لیست پیام‌های ارسالی و دریافتی با صفحه‌بندی

    دریافت پیام‌های خوانده‌نشده و بروزرسانی خودکار وضعیت

    مدیریت دفترچه تلفن (ایجاد، حذف، افزودن/حذف شماره)

    مدیریت لیست سیاه (افزودن، حذف، بررسی وجود)

    دریافت اعتبار و اطلاعات کامل کاربر

    ثبت‌نام کاربر جدید از طریق وب سرویس

    کاملاً سازگار با لاراول ۹، ۱۰، ۱۱ و ۱۲

    Auto-Discovery در لاراول

    مدیریت خطاهای حرفه‌ای با Exception‌های اختصاصی

📦 نصب
bash

composer require pishropayamak/sms

⚙️ تنظیمات
انتشار فایل کانفیگ (اختیاری)
bash

php artisan vendor:publish --tag=pishropayamak-config

متغیرهای محیطی در فایل .env
env

PISHROPAYAMAK_TOKEN=your_token_here
PISHROPAYAMAK_FROM=9444xxxxxx
PISHROPAYAMAK_TYPE=0
PISHROPAYAMAK_BASE_URL=https://api-payamak.com/api/v3/rest
PISHROPAYAMAK_TIMEOUT=30

متغیر	توضیح
PISHROPAYAMAK_TOKEN	توکن دریافتی از پنل کاربری (اجباری)
PISHROPAYAMAK_FROM	شماره خط اختصاصی (اختیاری)
PISHROPAYAMAK_TYPE	نوع پیام پیش‌فرض: ۰=معمولی، ۱=فلش
PISHROPAYAMAK_BASE_URL	آدرس پایه API (نسخه ۳)
PISHROPAYAMAK_TIMEOUT	تایم‌اوت درخواست به ثانیه
🚀 نحوه استفاده
روش اول: استفاده از Facade (ساده‌ترین)
php

use PishroPayamak\Sms\Facades\PishroPayamak;

$response = PishroPayamak::sendSms(
    '9444xxxxxx',
    ['09121234567', '09129876543'],
    'متن پیام شما',
    0
);

if ($response['return']['status'] == 200) {
    echo "✅ کد پیگیری: " . $response['data']['messageid'];
} else {
    echo "❌ خطا: " . $response['return']['message'];
}

روش دوم: تزریق وابستگی (Dependency Injection)
php

use PishroPayamak\Sms\SmsService;

class SmsController extends Controller
{
    public function send(SmsService $sms)
    {
        $response = $sms->sendSms(
            '9444xxxxxx',
            ['09121234567'],
            'متن پیام شما'
        );

        return response()->json($response);
    }
}

روش سوم: استفاده از app() helper
php

$sms = app('pishropayamak.sms');
$response = $sms->sendSms('9444xxxxxx', ['09121234567'], 'متن پیام شما');

📋 متدهای کامل پکیج
🟢 سرویس پیامک (SMS)
متد	توضیح
sendSms($from, $recipients, $message, $type)	ارسال پیامک به یک یا چند گیرنده
sendMultiple($fromArray, $recipients, $messageArray, $typeArray)	ارسال گروهی با پیام‌های متفاوت
getStatus($messageIds)	دریافت وضعیت پیام‌ها (حداکثر ۵۰ عدد)
getSelect($messageIds)	دریافت جزئیات کامل پیام‌ها
getOutbox($startDate, $endDate)	لیست ارسال‌ها در بازه زمانی
getLatest()	آخرین وضعیت پیام ارسال‌شده
getLatestOutbox($pageSize)	آخرین ارسال‌ها (حداکثر ۲۰۰)
countOutbox($startDate, $endDate)	تعداد ارسال‌ها در بازه زمانی
countInbox($startDate, $endDate, $number, $isRead)	تعداد دریافت‌ها با فیلتر
getInbox($count, $offset)	دریافت پیام‌های دریافتی
getInboxPaged($number, $isRead, $page, $pageSize)	دریافت پیام‌های دریافتی با صفحه‌بندی
receive($number, $isRead)	دریافت پیام‌های خوانده‌نشده و بروزرسانی
getStatusByNumber($number, $startDate, $pageSize)	وضعیت پیام‌های یک شماره خاص
🟢 سرویس کاربر (User)
متد	توضیح
getCredit()	دریافت اعتبار باقی‌مانده (ریال)
getUserDetails()	دریافت اطلاعات کامل کاربر
registerUser($uname, $passwd, $passwd_repeat, $parent, $mobile, $melli_code, $package, $reseller)	ثبت‌نام کاربر جدید
🟢 دفترچه تلفن (Phonebook)
متد	توضیح
getPhonebooks($name)	فهرست دفترچه‌های تلفن
getPhonebookNumbers($book_id)	شماره‌های یک دفترچه
createPhonebook($name, $numbers, $flag)	ایجاد دفترچه جدید
deletePhonebook($book_id)	حذف دفترچه
addToPhonebook($book_id, $numbers, $flag)	افزودن شماره به دفترچه
removeFromPhonebook($book_id, $numbers, $flag)	حذف شماره از دفترچه
🟢 لیست سیاه (Blocked)
متد	توضیح
getBlockedList($number, $startDate, $page, $pageSize)	دریافت لیست سیاه یک خط
addToBlocked($number, $targets)	افزودن شماره به لیست سیاه
removeFromBlocked($number, $target)	حذف شماره از لیست سیاه
isBlocked($number, $targets)	بررسی وجود شماره در لیست سیاه
📝 پارامترهای متد sendSms
پارامتر	نوع	ضروری	توضیح
$from	string	بله	شماره خط اختصاصی
$recipients	array	بله	لیست گیرندگان (حداکثر ۲۰۰ عدد)
$message	string	بله	متن پیام (حداکثر ۹۰۰ کاراکتر)
$type	int	خیر	۰=معمولی، ۱=فلش (پیش‌فرض ۰)
📤 ساختار خروجی
✅ در صورت موفقیت
php

[
    'return' => [
        'status' => 200,
        'message' => 'پیام با موفقیت در صف ارسال قرار گرفت'
    ],
    'data' => [
        'messageid' => 8792343,
        'message' => 'متن پیام',
        'state' => 'فعال',
        'from' => '9444xxxxxx',
        'date' => 1786619709
    ]
]

❌ در صورت خطا
php

[
    'return' => [
        'status' => 401,
        'message' => 'توکن نامعتبر است'
    ]
]

🧪 مدیریت خطاها
php

use PishroPayamak\Sms\Facades\PishroPayamak;
use PishroPayamak\Sms\Exceptions\AuthenticationException;
use PishroPayamak\Sms\Exceptions\ValidationException;
use PishroPayamak\Sms\Exceptions\SmsException;

try {
    $response = PishroPayamak::sendSms('9444xxxxxx', ['09121234567'], 'متن');
} catch (AuthenticationException $e) {
    // توکن نامعتبر یا منقضی
    Log::error('خطای احراز هویت: ' . $e->getMessage());
} catch (ValidationException $e) {
    // پارامترهای ورودی نامعتبر
    Log::error('خطای اعتبارسنجی: ' . $e->getMessage());
} catch (SmsException $e) {
    // سایر خطاهای سرویس
    Log::error('خطای سرویس: ' . $e->getMessage());
}

🔒 نکات امنیتی

    توکن را هرگز در کد قرار ندهید؛ همیشه از متغیرهای محیطی استفاده کنید.

    برای ارتباط با سرور از پروتکل HTTPS استفاده می‌شود.

    توکن‌ها دارای تاریخ انقضا هستند؛ به‌طور دوره‌ای آنها را تمدید کنید.

    در صورت پایان کار، توکن را از پنل کاربری باطل کنید.

🧪 تست
bash

composer test

📚 منابع و مستندات بیشتر

    وب‌سایت رسمی: https://pishropayamak.ir

    مستندات کامل API: https://pishropayamak.ir/api/v3/rest

    مخزن گیت‌هاب: https://github.com/MohammadrezaRahpeyma/pishropayamak-sms

    پشتیبانی: mr.rezarahpeyma@gmail.com

📄 مجوز

این پکیج تحت مجوز MIT منتشر شده است.
🙏 مشارکت

اگر مشکلی پیدا کردید یا پیشنهادی برای بهبود دارید، خوشحال می‌شویم که در مخزن گیت‌هاب Issue ایجاد کنید یا Pull Request ارسال نمایید.

ساخته شده با ❤️ توسط پیشرو پیامک

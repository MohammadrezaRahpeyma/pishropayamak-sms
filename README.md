markdown

# 📱 پکیج ارسال پیامک پیشرو پیامک

پکیج رسمی **پیشرو پیامک** برای ارسال آسان پیامک در پروژه‌های لاراول.

## ✨ ویژگی‌ها

- ارسال پیامک با احراز هویت توکن
- پشتیبانی از ارسال گروهی
- دریافت کد پیگیری
- کاملاً سازگار با لاراول ۹ تا ۱۱

## 📦 نصب

```bash
composer require pishropayamak/sms

⚙️ تنظیمات

فایل کانفیگ را منتشر کنید:
bash

php artisan vendor:publish --tag=pishropayamak-config

سپس مقادیر زیر را به فایل .env خود اضافه کنید:
env

PISHROPAYAMAK_TOKEN=your_token_here
PISHROPAYAMAK_FROM=9444xxxxxx
PISHROPAYAMAK_TYPE=0

🚀 استفاده
روش اول: استفاده از Facade
php

use PishroPayamak\Sms\Facades\PishroPayamak;

$response = PishroPayamak::sendSms(
    '9998xxxxxx',
    ['09121234567'],
    'متن پیام شما'
);

if ($response['success']) {
    echo "کد پیگیری: " . $response['id'];
} else {
    echo "خطا: " . $response['error'];
}

روش دوم: استفاده از کلاس به صورت مستقیم
php

use PishroPayamak\Sms\SmsService;

$sms = app(SmsService::class);
$response = $sms->sendSms('9998xxxxxx', ['09121234567'], 'متن پیام شما');

روش سوم: تزریق وابستگی
php

use PishroPayamak\Sms\SmsService;

class YourController
{
    public function send(SmsService $sms)
    {
        $response = $sms->sendSms('9998xxxxxx', ['09121234567'], 'متن پیام شما');
        return response()->json($response);
    }
}

🔧 متد sendSms

sendSms(string $from, array $recipients, string $message, int $type = 0): array

پارامتر	نوع	توضیح
$from	    string	شماره فرستنده (خط اختصاصی)
$recipients	array	لیست شماره گیرندگان
$message	string	متن پیامک
$type	    int	    0=معمولی، 1=فلش 

📝 نمونه خروجی
[
    'success' => true,
    'id' => 123456
]
خطا
[
    'success' => false,
    'error' => 'کد خطا: 401'
]

🧪 تست
composer test

🌐 وب‌سایت
https://pishropayamak.ir/
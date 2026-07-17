<?php

namespace PishroPayamak\Sms;

class SmsService
{
    private string $token;
    private string $baseUrl = 'https://api-payamak.com/api/v1/rest/';

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function sendSms(string $from, array $recipients, string $message, int $type = 0): array
    {
        $url = $this->baseUrl . 'sms/send';
        $payload = [
            'from'       => $from,
            'recipients' => $recipients,
            'message'    => $message,
            'type'       => $type
        ];

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_CUSTOMREQUEST  => "POST",
            CURLOPT_POSTFIELDS     => json_encode($payload, JSON_UNESCAPED_UNICODE),
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                'token: ' . $this->token
            ],
        ]);

        $response = curl_exec($curl);
        $error    = curl_error($curl);
        curl_close($curl);

        if ($error) {
            return ['success' => false, 'error' => "خطای شبکه: $error"];
        }

        $result = json_decode($response, true);

        if (isset($result['status']) && $result['status'] == 200 && isset($result['result']['id']) && $result['result']['id'] > 0) {
            return [
                'success' => true,
                'id'      => $result['result']['id']
            ];
        }

        $errorCode = $result['result']['status'] ?? ($result['status'] ?? 'Unknown');
        return [
            'success' => false,
            'error'   => "کد خطا: $errorCode"
        ];
    }
}
<?php

namespace App\SMSProviders;

use App\Events\SMSGateway\SMSSentEvent;
use App\Interfaces\SMSProvider\SMSGatewayInterface;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GhasedakProvider implements SMSGatewayInterface
{
    /**
     * @var string|mixed
     */
    private string $apiKey;

    /**
     * @var string
     */
    private string $url;

    /**
     * @var string
     */
    private string $sender;

    public function __construct()
    {
        $this->apiKey = env('GHASEDAK_API_KEY');
        $this->sender = env('GHASEDAK_SENDER');
        $this->url = "https://api.ghasedak.com/v1/{$this->apiKey}/sms/send.json";

        $this->makeFakeHttpForGhasedak();
    }

    private function makeFakeHttpForGhasedak()
    {
        Http::fake([
            'https://api.ghasedak.com/*' =>
                Http::response([
                    'return' => [
                        'status' => 200,
                        'message' => 'Send successfully'
                    ]
                ])
        ]);
    }

    /**
     * @param string $to
     * @param string $message
     *
     * @return void
     */
    public function send(string $to, string $message): void
    {
        try {
            $response = Http::timeout(15)
                ->get(
                    $this->url,
                    http_build_query([
                        'receptor' => $to,
                        'message' => htmlentities($message),
                        'sender' => $this->sender
                    ])
                );

            $this->saveResult($to, $response->json(), $response->status());
        } catch (ConnectionException $exception) {
            $this->saveResult(
                $to,
                ['return' => ['message' => 'Timeout connection']],
                $exception->getCode()
            );
        }
    }

    /**
     * @param string $to
     * @param array|string $jsonData
     * @param int $statusCode
     * @return void
     */
    public function saveResult(string $to, array|string $jsonData, int $statusCode): void
    {
        $result = is_string($jsonData) ? json_decode($jsonData) : $jsonData;

        event(
            new SMSSentEvent(
                $to,
                "Ghasedak",
                $result['return'],
                $statusCode
            )
        );
    }
}

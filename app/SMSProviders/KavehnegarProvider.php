<?php

namespace App\SMSProviders;

use App\Events\SMSGateway\SMSSentEvent;
use App\Interfaces\SMSProvider\SMSGatewayInterface;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class KavehnegarProvider implements SMSGatewayInterface
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
        $this->apiKey = env('KAVEHNEGAR_API_KEY');
        $this->sender = env('KAVEHNEGAR_SENDER');
        $this->url = "https://api.kavenegar.com/v1/{$this->apiKey}/sms/send.json";
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
                "Kavehnegar",
                $result['return'],
                $statusCode
            )
        );
    }
}

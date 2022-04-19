<?php

namespace App\Events\SMSGateway;

use Illuminate\Queue\SerializesModels;

class SMSSentEvent
{
    use SerializesModels;

    public array $data;

    /**
     * @param string $to
     * @param string $provider
     * @param string $result
     * @param int $statusCode
     */
    public function __construct(string $to, string $provider, string $result, int $statusCode)
    {
        $this->data = [
            'to' => $to,
            'provider' => $provider,
            'result' => $result,
            'status_code' => $statusCode,
        ];
    }
}

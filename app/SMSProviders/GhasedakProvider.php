<?php

namespace App\SMSProviders;

use App\Interfaces\SMSProvider\SMSGatewayInterface;

class GhasedakProvider implements SMSGatewayInterface
{
    public function __construct()
    {
    }

    public function send(string $to, string $message): void
    {
        // TODO: Implement send() method.
    }

    public function saveResult(string $to, array|string $jsonData, int $statusCode): void
    {
        // TODO: Implement saveResult() method.
    }
}

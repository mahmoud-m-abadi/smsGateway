<?php

namespace App\Interfaces\SMSProvider;

interface SMSGatewayInterface
{
    /**
     * @param string $to TO.
     * @param string $message Message.
     *
     * @return void
     */
    public function send(string $to, string $message): void;

    /**
     * @param string $to
     * @param array|string $jsonData
     * @param int $statusCode
     *
     * @return void
     */
    public function saveResult(string $to, array|string $jsonData, int $statusCode): void;
}

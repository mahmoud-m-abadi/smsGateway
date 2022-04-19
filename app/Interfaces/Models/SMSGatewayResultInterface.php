<?php

namespace App\Interfaces\Models;

interface SMSGatewayResultInterface
{
    public function getList();

    public function createObject(array $data);
}

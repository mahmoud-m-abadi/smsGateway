<?php

namespace App\Interfaces\Models;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface SMSGatewayResultInterface
{
    public function paginate(): LengthAwarePaginator;

    public function getList(): Collection;

    public function createObject(array $data): SMSGatewayResultInterface;
}

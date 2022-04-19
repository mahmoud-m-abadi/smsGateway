<?php

namespace App\Interfaces\Repositories;

use App\Interfaces\Models\SMSGatewayResultInterface;
use Illuminate\Support\Collection;

interface SMSGatewayRepositoryInterface
{
    /**
     * @return Collection
     */
    public function list(): Collection;

    /**
     * @param array $data
     * @return SMSGatewayResultInterface
     */
    public function saveSMSResult(array $data): SMSGatewayResultInterface;
}

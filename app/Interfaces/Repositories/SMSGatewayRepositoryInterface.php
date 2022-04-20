<?php

namespace App\Interfaces\Repositories;

use App\Interfaces\Models\SMSGatewayResultInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface SMSGatewayRepositoryInterface
{
    /**
     * @return LengthAwarePaginator
     */
    public function paginate(): LengthAwarePaginator;

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

<?php

namespace App\Repositories;

use App\Interfaces\Models\SMSGatewayResultInterface;
use App\Interfaces\Repositories\SMSGatewayRepositoryInterface;
use Illuminate\Support\Collection;

class SMSGatewayRepository implements SMSGatewayRepositoryInterface
{
    private SMSGatewayResultInterface $gatewayModel;

    public function __construct(
        SMSGatewayResultInterface $gatewayModel
    )
    {

        $this->gatewayModel = $gatewayModel;
    }

    /**
     * @return Collection
     */
    public function list(): Collection
    {
        return $this->gatewayModel->getList();
    }

    /**
     * @param array $data
     * @return void
     */
    public function saveSMSResult(array $data): SMSGatewayResultInterface
    {
        return $this->gatewayModel->createObject($data);
    }
}

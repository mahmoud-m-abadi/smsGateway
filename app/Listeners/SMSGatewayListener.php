<?php

namespace App\Listeners;

use App\Events\SMSGateway\SMSSentEvent;
use App\Repositories\SMSGatewayRepository;

class SMSGatewayListener
{
    private SMSGatewayRepository $repository;

    public function __construct(SMSGatewayRepository $repository)
    {
        $this->repository = $repository;
    }

    public function onSent($event)
    {
        $this->repository->saveSMSResult($event->data);
    }

    public function subscribe($events)
    {
        $events->listen(
            SMSSentEvent::class,
            "App\Listeners\SMSGatewayListener@onSent"
        );
    }
}

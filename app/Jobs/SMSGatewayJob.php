<?php

namespace App\Jobs;

use App\Interfaces\SMSProvider\SMSGatewayInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SMSGatewayJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    public string $to;

    /**
     * @var string
     */
    public string $message;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $to, string $message)
    {
        $this->to = $to;
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(SMSGatewayInterface $gateway)
    {
        $gateway->send(
            $this->to,
            $this->message,
        );
    }
}

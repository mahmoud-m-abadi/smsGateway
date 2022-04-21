<?php

namespace App\Providers;

use App\Interfaces\Models\SMSGatewayResultInterface;
use App\Interfaces\Repositories\SMSGatewayRepositoryInterface;
use App\Interfaces\SMSProvider\SMSGatewayInterface;
use App\Models\SMSGatewayResult;
use App\Repositories\SMSGatewayRepository;
use App\SMSProviders\KavehnegarProvider;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use function PHPUnit\Framework\throwException;

class SMSGatewayProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(SMSGatewayInterface::class, function ($app) {
            $configProvider = env('SMS_PROVIDER', 'Kavehnegar');
            $configProvider = Str::ucfirst($configProvider);

            $providerName = "\\App\\SMSProviders\\" . $configProvider . "Provider";

            throw_if(
                !class_exists($providerName),
                new \Exception("There is no such provider, please contact administrator")
            );

            return new $providerName();
        });

        $this->app->bind(SMSGatewayRepositoryInterface::class, SMSGatewayRepository::class);
        $this->app->singleton(SMSGatewayResultInterface::class, SMSGatewayResult::class);
    }


    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

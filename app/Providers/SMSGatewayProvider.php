<?php

namespace App\Providers;

use App\Interfaces\Models\SMSGatewayResultInterface;
use App\Interfaces\SMSProvider\SMSGatewayInterface;
use App\Models\SMSGatewayResult;
use App\SMSProviders\KavehnegarProvider;
use Illuminate\Support\ServiceProvider;
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
            $smsGateways = [
                'Kavehnegar',
                'Ghasedak',
            ];

            $configProvider = env('SMS_PROVIDER', 'Kavehnegar');
            $providerName = "\\App\\SMSProviders\\" . $smsGateways[$configProvider] . "Provider";
            $filePath = base_path() . "/SMSProviders/" . $smsGateways[$configProvider] . "Provider.php";

            if (!file_exists($filePath)) {
                throwException(
                    new \Exception("There is no such provider, please contact administrator")
                );
            }

            return new $providerName();
        });

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

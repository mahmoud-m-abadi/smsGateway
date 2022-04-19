<?php

namespace App\Models;

use App\Interfaces\Models\SMSGatewayResultInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SMSGatewayResult extends Model implements SMSGatewayResultInterface
{
    use HasFactory;

    protected $table = 'sms_gateway_results';

    protected $fillable = [
        'provider',
        'result',
        'status_code'
    ];
}

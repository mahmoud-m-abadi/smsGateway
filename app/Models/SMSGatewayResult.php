<?php

namespace App\Models;

use App\Interfaces\Models\SMSGatewayResultInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class SMSGatewayResult extends Model implements SMSGatewayResultInterface
{
    use HasFactory;

    protected $table = 'sms_gateway_results';

    protected $fillable = [
        'to',
        'provider',
        'result',
        'status_code'
    ];

    protected $casts = [
        'result' => 'array'
    ];

    public function paginate(): LengthAwarePaginator
    {
        return self::orderByDesc('id')->paginate();
    }

    public function getList(): Collection
    {
        return self::orderByDesc('id')->get();
    }

    public function createObject(array $data): SMSGatewayResultInterface
    {
        return self::create($data);
    }
}

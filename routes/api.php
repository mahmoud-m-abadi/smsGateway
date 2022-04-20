<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SMSGatewayController;

Route::get('sms', [SMSGatewayController::class, 'list'])->name('sms.list');
Route::post('sms', [SMSGatewayController::class, 'send'])->name('sms.send');

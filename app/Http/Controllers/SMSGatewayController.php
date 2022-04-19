<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendSMSGatewayRequest;
use App\Jobs\SMSGatewayJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SMSGatewayController extends Controller
{
    public function __construct()
    {
    }

    public function list()
    {

    }

    /**
     * @param SendSMSGatewayRequest $request
     * @return JsonResponse
     */
    public function send(SendSMSGatewayRequest $request): JsonResponse
    {
        SMSGatewayJob::dispatch(
            $request->get('to'),
            $request->get('message')
        );

        return $this->response(null, Response::HTTP_NO_CONTENT);
    }
}

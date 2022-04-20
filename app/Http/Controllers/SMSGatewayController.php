<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendSMSGatewayRequest;
use App\Http\Resources\SMSGatewayResource;
use App\Interfaces\Repositories\SMSGatewayRepositoryInterface;
use App\Jobs\SMSGatewayJob;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\View;

class SMSGatewayController extends Controller
{
    private SMSGatewayRepositoryInterface $repository;

    public function __construct(SMSGatewayRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return View
     */
    public function listForWeb(): View
    {
        return view('dashboard', [
            'items' => $this->repository->paginate()
        ]);
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function list(): AnonymousResourceCollection
    {
        return SMSGatewayResource::collection(
            $this->repository->paginate()
        );
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

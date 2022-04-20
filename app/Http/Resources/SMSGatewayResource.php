<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SMSGatewayResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'to' => $this->to,
            'provider' => $this->provider,
            'result' => $this->result,
            'status_code' => $this->status_code,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}

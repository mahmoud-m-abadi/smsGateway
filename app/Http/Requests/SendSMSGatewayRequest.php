<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendSMSGatewayRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'to' => [
                'required',
                'regex:09(1[0-9]|3[1-9]|2[1-9])-?[0-9]{3}-?[0-9]{4}'
            ],
            'message' => [
                'required',
                'string',
                'min:2',
                'max:55'
            ]
        ];
    }
}

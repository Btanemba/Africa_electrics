<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryRequest extends FormRequest
{
    public function authorize()
    {
        return backpack_auth()->check();
    }

    public function rules()
    {
        return [
            'status' => 'required|in:shipped,delivered',
        ];
    }
}

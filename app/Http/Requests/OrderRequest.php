<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize()
    {
        return backpack_auth()->check();
    }

    public function rules()
    {
        return [
            'status' => 'required|in:pending,confirmed,shipped,delivered,cancelled',
        ];
    }
}

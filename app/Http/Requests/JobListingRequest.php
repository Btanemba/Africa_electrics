<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobListingRequest extends FormRequest
{
    public function authorize()
    {
        return backpack_auth()->check();
    }

    public function rules()
    {
        return [
            'title' => 'required|min:3|max:255',
            'description' => 'required',
            'type' => 'required|in:full-time,part-time,contract,internship',
            'deadline' => 'nullable|date|after:today',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamMemberRequest extends FormRequest
{
    public function authorize()
    {
        return backpack_auth()->check();
    }

    public function rules()
    {
        return [
            'name' => 'required|min:2|max:255',
            'role' => 'required|max:255',
            'bio'  => 'nullable|max:500',
        ];
    }
}

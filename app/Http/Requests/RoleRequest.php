<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    public function authorize()
    {
        return backpack_auth()->check();
    }

    public function rules()
    {
        $roleId = $this->route('id');

        return [
            'name' => "required|string|max:255|unique:roles,name,{$roleId}",
            'code' => 'nullable|string|max:255|unique:roles,code,'.$roleId,
            'description' => 'nullable|string|max:255',
        ];
    }
}

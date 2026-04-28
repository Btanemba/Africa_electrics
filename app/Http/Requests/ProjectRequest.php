<?php

namespace App\Http\Requests;

use App\Models\Project;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return backpack_auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:2', 'max:255'],
            'category' => ['required', Rule::in(array_keys(Project::categoryOptions()))],
            'summary' => ['required', 'string', 'max:500'],
            'project_images' => ['nullable', 'array'],
            'project_images.*' => ['image', 'max:5120'],
            'location' => ['nullable', 'string', 'max:255'],
            'project_year' => ['nullable', 'integer', 'min:1900', 'max:' . ((int) date('Y') + 1)],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyFilterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company'           => ['nullable', 'string', 'max:255'],
            'location'          => ['nullable', 'string', 'max:255'],
            'industry'          => ['nullable', 'integer', 'exists:categories,category_id'],
        ];
    }
}

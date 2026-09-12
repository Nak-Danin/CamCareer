<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CareerFilterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'keyword'           => ['nullable', 'string', 'max:255'],
            'location'          => ['nullable', 'string', 'max:255'],
            'category'          => ['nullable', 'integer', 'exists:categories,category_id'],
            'employment_type'   => ['nullable', 'array'],
            'employment_type.*' => ['string', 'in:full-time,part-time,internship,contract'],
            'sort'              => ['nullable', 'in:recent'],
        ];
    }
}

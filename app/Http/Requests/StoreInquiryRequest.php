<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreInquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'organization' => ['nullable', 'string', 'max:160'],
            'email' => ['required', 'email', 'max:160'],
            'phone' => ['nullable', 'string', 'max:160'],
            'service' => ['required', Rule::in(array_keys(config('bcrl.services')))],
            'message' => ['required', 'string', 'min:20', 'max:3000'],
            'company_website' => ['nullable', 'max:0'],
        ];
    }
}

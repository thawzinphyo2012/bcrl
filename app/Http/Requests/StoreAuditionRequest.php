<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAuditionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:120'],
            'age' => ['nullable', 'integer', 'min:8', 'max:99'],
            'city' => ['required', 'string', 'max:120'],
            'contact' => ['required', 'string', 'max:160'],
            'email' => ['nullable', 'email', 'max:160'],
            'interest' => ['required', Rule::in(array_keys(config('bcrl.interests')))],
            'experience' => ['required', Rule::in(array_keys(config('bcrl.experiences')))],
            'why' => ['required', 'string', 'min:20', 'max:2000'],
            'demo_url' => ['nullable', 'url', 'max:500'],
            'consent' => ['accepted'],
            'company_website' => ['nullable', 'max:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'consent.accepted' => 'Please confirm that BCRL may contact you about this application.',
            'why.min' => 'Tell us a little more — at least a sentence or two.',
            'company_website.max' => 'This application could not be submitted.',
        ];
    }
}

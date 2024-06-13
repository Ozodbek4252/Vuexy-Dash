<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanySettingsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->method() === 'POST') {
            $logo = 'required|image|mimes:jpeg,png,jpg,gif,svg,ico,webp|max:2048';
        } else {
            $logo = 'nullable|image|mimes:jpeg,png,jpg,gif,svg,ico,webp|max:2048';
        }

        return [
            'name' => 'required|string',
            'logo' => $logo,
            'logo_secondary' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,ico,webp|max:2048'
        ];
    }
}

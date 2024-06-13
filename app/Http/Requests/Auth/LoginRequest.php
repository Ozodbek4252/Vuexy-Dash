<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
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
        return [
            'email' => 'required|email',
            'password' => 'required',
            'remember' => 'nullable|in:on',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        foreach ($validator->errors()->all() as $error) {
            Flasher::addError($error);
        }

        $response = redirect()->back()
            ->withErrors($validator)
            ->withInput($this->all());

        throw new ValidationException($validator, $response);
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class IconRequest extends FormRequest
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
        if ($this->_method == 'PUT') {
            $icon = 'nullable|image|mimes:jpeg,png,jpg,ico,svg';
        } else {
            $icon = 'required|image|mimes:jpeg,png,jpg,ico,svg';
        }

        return [
            'name' => 'required|string',
            'icon' => $icon,
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

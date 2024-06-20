<?php

namespace App\Http\Requests;

use App\Models\Lang;
use Illuminate\Foundation\Http\FormRequest;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class SeoRequest extends FormRequest
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
        $rules = [
            'keywords' => 'required|string',
        ];

        $langs = Lang::where('is_published', true)->get();
        foreach ($langs as $lang) {
            $rules['title_' . $lang->code] = 'required|string';
            $rules['description_' . $lang->code] = 'required|string';
        }

        return $rules;
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

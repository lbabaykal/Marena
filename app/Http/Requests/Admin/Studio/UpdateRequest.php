<?php

namespace App\Http\Requests\Admin\Studio;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:1|max:255|unique:studios',
        ];
    }

    public function messages()
    {
        return [
            'title.unique' => 'Такая студия уже существует'
        ];
    }
}
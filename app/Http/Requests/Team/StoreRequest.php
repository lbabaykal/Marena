<?php

namespace App\Http\Requests\Team;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'logo' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048'],
            'title' => ['required', 'string', 'min:3', 'max:255', 'unique:teams,title'],
            'description' => ['nullable', 'string'],
        ];
    }

}

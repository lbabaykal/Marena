<?php

namespace App\Http\Requests\Admin\Role;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
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
            'title' => 'required|string|min:1|max:255|unique:roles',
            'isAdmin' => 'nullable|string',
            'allowView' => 'nullable|string',
            'allowCreate' => 'nullable|string',
            'allowUpdate' => 'nullable|string',
            'allowDelete' => 'nullable|string',
        ];
    }
}

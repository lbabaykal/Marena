<?php

namespace App\Http\Requests\Admin\Role;

use App\Models\Role1111;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
//            'title' => ['required', 'string', 'min:3', 'max:255', Rule::unique(Role::class)->ignore($this->id)],
            'title' => ['required', 'string', 'min:3', 'max:255', Rule::unique('roles')->ignore($this->role)],
            'isAdmin' => ['nullable', 'string'],
            'allowView' => ['nullable', 'string'],
            'allowCreate' => ['nullable', 'string'],
            'allowUpdate' => ['nullable', 'string'],
            'allowDelete' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.unique' => 'Такая роль уже существует.'
        ];
    }
}

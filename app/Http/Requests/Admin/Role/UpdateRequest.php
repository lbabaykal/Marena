<?php

namespace App\Http\Requests\Admin\Role;

use App\Models\Role;
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
            'id' => 'required|integer|exists:roles,id',
            'title' => ['required', 'string', 'min:3', 'max:255', Rule::unique(Role::class)->ignore($this->id)],
//            'title' => ['required', 'string', 'min:3', 'max:255', Rule::unique(Role::class)->ignore($this->id)],
            'isAdmin' => 'nullable|string',
            'allowView' => 'nullable|string',
            'allowCreate' => 'nullable|string',
            'allowUpdate' => 'nullable|string',
            'allowDelete' => 'nullable|string',
        ];
    }
}

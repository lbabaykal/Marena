<?php

namespace App\Http\Requests\Admin\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:users,id',
            'username' => ['required', 'string', 'min:3', 'max:255', Rule::unique(User::class)->ignore($this->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique(User::class)->ignore($this->id)],
            'role_id' => 'required|min:2|integer',
        ];
    }
}

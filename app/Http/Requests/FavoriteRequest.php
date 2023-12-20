<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FavoriteRequest extends FormRequest
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

        if ($this->request->has('folder_id')) {
            return [
                'folder_id' => 'required|integer|exists:folders,id',
                'article_id' => 'required|integer|exists:articles,id',
            ];
        } else {
            return [
                'article_id' => 'required|integer|exists:articles,id',
            ];
        }

    }
}

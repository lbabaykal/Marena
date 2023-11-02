<?php

namespace App\Http\Requests\Admin\Article;

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
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif', 'max:2048'],
            'title_rus' => ['required', 'string', 'min:1', 'max:255'],
            'title_orig' => ['required', 'string', 'min:1', 'max:255'],
            'title_eng' => ['required', 'string', 'min:1', 'max:255'],
            'category_id' => ['required', 'integer'],
            'type_id' => ['required', 'integer'],
            'studio_id' => ['required', 'integer'],
            'country_id' => ['required', 'integer'],
            'genre_id' => ['nullable', 'array'],
            'episodes' => ['nullable', 'string', 'max:255'],
            'release' => ['required', 'date', 'after:1980-01-01|', 'before:2100-01-01'],
            'age_limit' => ['nullable', 'integer'],
            'description' => ['nullable', 'string'],
            'is_show' => ['nullable', 'string'],
            'is_comment' => ['nullable', 'string'],
            'is_rating' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'year.min' => 'Год должен быть больше 1900',
            'year.max' => 'Год должен быть меньше 2100',
        ];
    }
}

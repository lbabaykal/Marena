<?php

namespace App\Http\Requests\Admin\Article;

use App\Models\Article;
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
            'title_rus' => ['required', 'string', 'min:1', 'max:255'],
            'title_orig' => ['required', 'string', 'min:1', 'max:255'],
            'title_eng' => ['required', 'string', 'min:1', 'max:255'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'type_id' => ['required', 'integer', 'exists:types,id'],
            'age_limit' => ['required', 'in:' . Article::age_limits()->implode(',')],
            'country_id' => ['required', 'integer', 'exists:countries,id'],
            'genre_id' => ['nullable', 'array'],
            'genre_id.*' => ['nullable', 'integer', 'exists:genres,id'],
            'studio_id' => ['nullable', 'array'],
            'studio_id.*' => ['nullable', 'integer', 'exists:studios,id'],
            'episodes_released' => ['required', 'integer', 'lte:episodes_total'],
            'episodes_total' => ['required', 'integer'],
            'duration' => ['required', 'integer'],
            'release' => ['required', 'date', 'after:1980-01-01|', 'before:2100-01-01'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:' . Article::statuses()->implode(',')],
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

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NewsCategoryRequest extends FormRequest
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
            'name'=>['required','max:255',Rule::unique('news_categories', 'name')->ignore($this->route('news_category'), 'slug')],
            'status' => 'required|in:active,inactive',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Category is required',
            'status.in' => 'The selected status is invalid. It must be either active or inactive.',
        ];
    }
}

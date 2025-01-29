<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'rss' => 'nullable',
            'category' => [
                'required',
                'exists:news_categories,id',
            ],
            'source' => [
                'nullable',
                'exists:news_sources,id',
            ],
            'status' =>  [
                'required',
                'in:active,inactive'
            ],
            'trending_news' => 'required|in:1,0',
        ];
        if ($this->isMethod('post')) { // Store method
            $rules['image'] = 'required|image|mimes:webp,jpeg,png,jpg,gif,svg|max:2048';
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) { // Update method
            $rules['image'] = 'nullable|image|mimes:webp,jpeg,png,jpg,gif,svg|max:2048';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'category.required' => 'Please select a category.',
            'category.exists' => 'The selected category is invalid.',
            'source.exists' => 'The selected source is invalid.',
            'status.in' => 'The status must be either active or inactive.'
        ];
    }
}

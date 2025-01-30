<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductBrandRequest extends FormRequest
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
            'name' => ['required', 'max:255', Rule::unique('product_brands', 'name')->ignore($this->route('products_brand'), 'slug')],
            'status' => 'required|in:active,inactive',
        ];
        if ($this->isMethod('post')) { // Store method
            $rules['image'] = 'required|image|mimes:webp,jpeg,png,jpg,gif,svg';
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) { // Update method
            $rules['image'] = 'nullable|image|mimes:webp,jpeg,png,jpg,gif,svg';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Brand is required',
            'status.in' => 'The selected status is invalid. It must be either active or inactive.',
        ];
    }
}

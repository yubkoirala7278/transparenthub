<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfessionalRequest extends FormRequest
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
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->route('professional'), 'slug')],
            'phone_number' => 'required|string|max:20',
            'bio' => 'required|string',
            'experience_years' => 'nullable|numeric|min:0',
            'location' => 'required|string|max:255',
            'category_id' => 'required|exists:professional_categories,id',
            'sub_category_id' => 'required|exists:professional_sub_categories,id',
            'status' => 'required|in:active,inactive',
            'rating' => 'nullable|numeric|min:0|max:5',
            
        ];
        if ($this->isMethod('post')) { // Store method
            $rules['profile_image'] = 'required|image|mimes:webp,jpeg,png,jpg,gif,svg';
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed']; // Password validation rules
            $rules['password_confirmation'] = ['required', 'string', 'min:8'];// Password confirmation rule
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) { // Update method
            $rules['profile_image'] = 'nullable|image|mimes:webp,jpeg,png,jpg,gif,svg';
            $rules['password'] = ['nullable', 'string', 'min:8', 'confirmed']; // Password validation rules
            $rules['password_confirmation'] = ['nullable', 'string', 'min:8'];// Password confirmation rule
        }
        return $rules;
    }
}

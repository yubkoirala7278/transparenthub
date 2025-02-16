<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PalikaRequest extends FormRequest
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
            'district_id' => ['required', 'exists:districts,id'],
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('palikas', 'name')->ignore($this->route('palika'), 'slug'),
            ],
            'population' => ['required', 'integer', 'min:1'],
            'total_area' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:active,inactive'],
        ];
    }

    public function messages()
    {
        return [
            'district_id.required' => 'District is required.',
            'district_id.exists' => 'The selected district does not exist.',

            'name.required' => 'Palika name is required.',
            'name.string' => 'Palika name must be a valid string.',
            'name.max' => 'Palika name must not exceed 255 characters.',
            'name.unique' => 'This Palika name already exists.',

            'population.required' => 'Population is required.',
            'population.integer' => 'Population must be an integer.',
            'population.min' => 'Population must be at least 1.',

            'total_area.required' => 'Total area is required.',
            'total_area.numeric' => 'Total area must be a valid number.',
            'total_area.min' => 'Total area must be a positive number.',

            'status.required' => 'Status is required.',
            'status.in' => 'The selected status is invalid. It must be either active or inactive.',
        ];
    }
}

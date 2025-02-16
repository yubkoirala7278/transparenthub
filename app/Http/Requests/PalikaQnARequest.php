<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PalikaQnARequest extends FormRequest
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
            'palika_id'      => 'required|exists:palikas,id',
            'questions'      => 'required|array|min:1',
            'questions.*'    => 'required|string',
            'answers'        => 'required|array|min:1',
            'answers.*'      => 'required|string',
            'status'         => 'required|in:active,inactive',
        ];
    }

    public function messages()
    {
        return [
            'status.in' => 'The selected status is invalid. It must be either active or inactive.',
            'palika_id.required' => 'Palika is required',
        ];
    }
}

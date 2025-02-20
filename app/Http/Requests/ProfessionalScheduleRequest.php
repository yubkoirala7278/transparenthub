<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfessionalScheduleRequest extends FormRequest
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
            'date' => ['required', 'date', 'after_or_equal:today'], // Ensures the date is today or later
            'start_time' => ['required', 'date_format:H:i'], // Validates time format (HH:MM)
            'end_time' => ['required', 'date_format:H:i'], // End time must be after start time
            'status' => ['required', 'in:available,booked'], // Ensures status is either 'available' or 'booked'
        ];
    }
}

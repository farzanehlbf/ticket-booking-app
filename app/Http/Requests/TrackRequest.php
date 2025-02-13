<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrackRequest extends FormRequest
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
            'search_id' => 'nullable|exists:trips,id',
            'reservation_id' => 'nullable|exists:reservations,id',
            'ticket_number' => 'nullable|exists:tickets,ticket_number',
        ];
    }
}

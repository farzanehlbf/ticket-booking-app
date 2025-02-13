<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
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
            'search_id' => 'required|exists:searches,id',
            'passengers_list' => 'required|array',
            'passengers_list.*.first_name' => 'required|string',
            'passengers_list.*.last_name' => 'required|string',
            'passengers_list.*.identity_id' => 'required|string',
            'passengers_list.*.phone_number' => 'required|string',
            'chair_numbers' => 'required|array',
        ];
    }
}

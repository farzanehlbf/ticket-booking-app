<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'origin_city_code' => 'nullable|string',
            'origin_terminal_code' => 'nullable|string',
            'origin_name' => 'nullable|string',
            'destination_city_code' => 'nullable|string',
            'destination_terminal_code' => 'nullable|string',
            'destination_name' => 'nullable|string',
            'date' => 'nullable|date_format:Y-m-d',
            'transport_type' => 'nullable|exists:transport_types,id',
        ];
    }
    public function messages()
    {
        return [
            'origin_city_code.string' => 'The origin city code must be a string.',
            'date.date_format' => 'The date must follow the format Y-m-d.',
        ];
    }
}

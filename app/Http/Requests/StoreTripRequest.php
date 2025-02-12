<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTripRequest extends FormRequest
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
            'origin_id' => 'required|exists:origins,id',
            'destination_id' => 'required|exists:destinations,id',
            'terminal_id' => 'required|exists:terminals,id',
            'transport_type_id' => 'required|exists:transport_types,id',
            'date' => 'required|date',
        ];
    }
}

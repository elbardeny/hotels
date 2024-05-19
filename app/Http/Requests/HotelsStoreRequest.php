<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelsStoreRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'country_code' => 'required|string|exists:countries,code',
            'city' => 'required|string|exists:cities,name',
            'price' => 'required|integer|min:1',
            'room_facilities' => 'sometimes|array',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelsListRequest extends FormRequest
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
            'name' => 'sometimes',
            'country' => 'sometimes',
            'city' => 'sometimes',
            'price' => 'sometimes',
            'sort_column' => 'sometimes|in:name,country,city,price',
            'sort_direction' => 'sometimes|in:asc,desc',
        ];
    }
}

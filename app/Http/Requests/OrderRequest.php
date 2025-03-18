<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:100'],
            'email' => ['nullable', 'email', 'max:100'],
            'phone' => ['required', 'numeric', 'digits_between:10,15'],
            'notes' => ['nullable', 'max:500'],
            // 'total_price' => ['required', 'numeric', 'lt:0'],
            // 'delivery_fee' => ['required', 'numeric', 'lt:0'],
            'address' => ['required', 'max:500'],
            'area_id' => ['required', 'exists:areas,id'],
        ];
    }
}

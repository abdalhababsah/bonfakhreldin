<?php

namespace App\Http\Requests;

use App\Enums\OrderDeliverableEnums;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'address' => ['required_if:deliverable,'.OrderDeliverableEnums::Delivery->value, 'max:500'],
            'area_id' => ['required_if:deliverable,'.OrderDeliverableEnums::Delivery->value, 'exists:areas,id'],
            'branch' => ['required_if:deliverable,'.OrderDeliverableEnums::Pickup->value],
            'deliverable' => ['required', Rule::in(OrderDeliverableEnums::cases())]
        ];
    }
}

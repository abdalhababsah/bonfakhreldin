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
            'phone' => ['required', 'numeric', 'digits_between:9,15'],
            'notes' => ['nullable', 'max:500'],
            'address' => ['required_if:deliverable,'.OrderDeliverableEnums::Delivery->value, 'max:500'],
            'area_id' => ['nullable', 'required_if:deliverable,'.OrderDeliverableEnums::Delivery->value, 'exists:areas,id'],
            'branch' => ['required_if:deliverable,'.OrderDeliverableEnums::Pickup->value],
            'deliverable' => ['required', Rule::in(OrderDeliverableEnums::cases())]
        ];
    }
}

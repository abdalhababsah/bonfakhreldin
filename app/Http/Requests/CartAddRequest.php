<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CartAddRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "size_id"=> ["required","integer",Rule::exists('product_sizes','id')->where('product_id', $this->id)],
            "quantity"=> ["required","integer","min:1"],
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;

class CartAddRequest extends FormRequest
{
    protected $stopOnFirstFailure = true;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "product_id" => ["required", "integer", Rule::exists('products', 'id')],
            "size_id" => ["required", "integer", Rule::exists('product_sizes', 'id')->where('product_id', request('product_id'))],
            "option_id" => ["nullable", "integer", Rule::exists('product_options', 'id')->where('product_id', request('product_id'))],
            "quantity" => ["required", "integer", "min:1"],
            "additions" => ["nullable", "array"],
            "additions.*.q" => [
                "integer",
                "min:1",
            ],
            "additions.*.id" => [
                Rule::exists('additions', 'id'),
            ],
        ];
    }
}

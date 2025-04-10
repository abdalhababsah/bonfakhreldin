<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
// use Log;

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
        Log::info('cart', $this->all());
        return [
            "product_id" => ["required", "integer", Rule::exists('products', 'id')],
            "size_id" => ["required", "integer", Rule::exists('product_sizes', 'id')->where('product_id', request('product_id'))],
            "option_id" => ["nullable", "integer", Rule::exists('product_options', 'id')->where('product_id', request('product_id'))],
            "quantity" => ["required", "integer", "min:1"],
            "additions" => ["nullable", "array"],
            "additions.*" => [
            "integer",
            Rule::exists('additions', 'id')->where(function ($query) {
                $query->where('product_id', request('product_id'));
            }),
            ],
            "additions" => [
            function ($attribute, $value, $fail) {
                foreach ($value as $key => $val) {
                if (!is_int($key)) {
                    $fail("The additions index must be an integer.");
                }
                }
            },
            ],
        ];
    }
}

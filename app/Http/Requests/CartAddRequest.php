<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
// use Log;

class CartAddRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        Log::info('Adding to cart', request()->all());
        return [
            "size_id"=> ["required","integer",Rule::exists('product_sizes','id')->where('product_id', request('product_id'))],
            "option_id"=> ["nullable","integer",Rule::exists('product_options','id')->where('product_id', request('product_id'))],
            "quantity"=> ["required","integer","min:1"],
        ];
    }
}

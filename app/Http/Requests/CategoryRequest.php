<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'description_en' => ['nullable', 'string','max:255'],
            'description_ar' => ['nullable','string', 'max:255'],
            'name_en' => ['required','between:3,10'],
            'name_ar' => ['required','between:3,10'],
            'category_id'=> ['nullable', Rule::exists('categories', 'id')->where(function ($query) {
                $query->where('category_id', null); // to be sure the category is main category
            })],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Adjust the max size as needed
        ];
    }
}

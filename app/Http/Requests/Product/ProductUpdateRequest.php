<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'name'        => ['required', 'min:3'],
            'description' => ['required', 'min:3'],
            'price'       => ['required', 'numeric'],
            'status'      => ['required', 'in:01,1'],
            'category_id' => ['required', 'numeric'],
            'image.*'     => ['image'],
            'title.*'     => [],
        ];
    }
}
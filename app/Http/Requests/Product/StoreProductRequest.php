<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'title' => 'required|unique:products,title|max:100',
            'product_category_id' => 'required|numeric',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'description' => 'required|min:15',
            'thumbnail_img' => 'required|file|image|mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
            'images.*' => 'required|file|image|mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
        ];
    }
}

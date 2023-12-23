<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'title' => 'required|max:100|unique:products,title,' . $this->product_id,
            'product_category_id' => 'required|numeric',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'description' => 'required|min:15',
            'thumbnail_img' => 'nullable|file|image|mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
            'images.*' => 'nullable|file|image|mimes:png,jpg,jpeg,gif,webp,svg|max:2048',
        ];
    }
}

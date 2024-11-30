<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string',
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric',
            'slug' => 'sometimes|string|unique:products,slug,' . $this->route('id'),
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'price.numeric' => 'The price must be a numeric value.',
            'slug.unique' => 'This slug is already in use.',
            'is_active.boolean' => 'The is_active field must be true or false.',
            'image.image' => 'The avatar must be an image.',
            'image.mimes' => 'The avatar must be a file of type: jpeg, png, jpg, gif.',
            'image.max' => 'The avatar must not be larger than 2MB.',
        ];
    }
}

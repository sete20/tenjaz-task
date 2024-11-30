<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string',
            'username' => 'sometimes|string|unique:users,username,' . $this->route('id'),
            'password' => 'sometimes|string|min:6',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation            'type' => 'sometimes|in:normal,gold,silver',
            'is_active' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'username.unique' => 'This username is already taken.',
            'password.min' => 'The password must be at least 6 characters long.',
            'type.in' => 'The type must be one of: normal, gold, or silver.',
            'is_active.boolean' => 'The is_active field must be true or false.',
            'avatar.image' => 'The avatar must be an image.',
            'avatar.mimes' => 'The avatar must be a file of type: jpeg, png, jpg, gif.',
            'avatar.max' => 'The avatar must not be larger than 2MB.'
        ];
    }
}

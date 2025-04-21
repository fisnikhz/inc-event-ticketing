<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\APIRequest;

class UpdateProfileRequest extends APIRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . auth()->id(),
            'password' => 'nullable|string|min:8|confirmed',
        ];
    }
}

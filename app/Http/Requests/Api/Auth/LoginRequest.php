<?php

namespace App\Http\Requests\Api\Auth;

use App\Http\Requests\Api\APIRequest;

class LoginRequest extends APIRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }
}

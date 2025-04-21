<?php

namespace App\Http\Requests\Api\Event;

use App\Http\Requests\Api\APIRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends APIRequest
{

    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => 'string',
            'date' => 'date',
            'venue_id' => 'exists:venues,id',
        ];
    }
}

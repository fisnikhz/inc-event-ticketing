<?php

namespace App\Http\Requests\Api\Event;

use App\Http\Requests\Api\APIRequest;

class StoreEventRequest extends APIRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'date' => 'required|date',
            'price' => 'required|numeric',
            'venue_id' => 'required|exists:venues,id',
        ];
    }
}

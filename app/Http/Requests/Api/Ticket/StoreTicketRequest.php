<?php

namespace App\Http\Requests\Api\Ticket;

use App\Http\Requests\Api\APIRequest;

class StoreTicketRequest extends APIRequest
{

    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'event_id' => 'required|integer|exists:events,id',
        ];
    }
}

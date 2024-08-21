<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FetchTasksRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => 'integer',
            'perPage' => 'integer'
        ];
    }
}

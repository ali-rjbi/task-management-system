<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FetchTasksRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => 'integer',
            'status' => 'integer|exists:task_statuses,id',
            'due_date' => 'date',
            'perPage' => 'integer|max:50'
        ];
    }
}

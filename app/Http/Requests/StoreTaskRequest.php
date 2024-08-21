<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'filled',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status_id' => 'required|exists:task_statuses,id',
            'priority_id' => 'required|exists:task_priorities,id',
            'due_date' => 'nullable|date',
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->routeIs('tasks.store')) {
            $this->merge([
                'user_id' => $this->user()->id
            ]);
        }
    }
}

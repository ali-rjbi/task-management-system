<?php

namespace App\Http\Requests;

use App\Contracts\Repositories\UserRepositoryInterface;
use Closure;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param UserRepositoryInterface $repository
     * @return array
     */
    public function rules(UserRepositoryInterface $repository): array
    {
        return [
            'name' => ['required', 'string', 'max:50'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'email' => [
                'required',
                'string',
                'email',
                // custom exists rule that does not inform user
                // that the email does not exist
                function (string $attribute, mixed $value, Closure $fail) use ($repository) {
                    if ($repository->emailExists($value)) {
                        $fail("Duplicate entry '{$value}'");
                    }
                },
            ],
        ];
    }
}

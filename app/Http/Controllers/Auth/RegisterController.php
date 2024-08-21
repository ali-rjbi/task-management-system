<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use JetBrains\PhpStorm\ArrayShape;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Http\Requests\RegisterRequest;
use App\Traits\Responses\FormatsAuthErrorResponses;
use App\Traits\Responses\FormatsAuthResponses;

class RegisterController extends Controller
{
    use FormatsAuthResponses,
        FormatsAuthErrorResponses;

    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    /**
     * Fulfill the registration process.
     */
    public function __invoke(RegisterRequest $request): Response
    {
        $user = $this->repository->create(
            $this->assembleFields($request)
        );

        return $user->exists()
            ? $this->registeredSuccessfully()
            : $this->registrationFailed();
    }

    /**
     * assemble the creating fields for user
     */
    private function assembleFields(FormRequest $request): array
    {
        return [
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'password' => bcrypt($request->validated('password')),
        ];
    }
}

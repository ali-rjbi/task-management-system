<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Contracts\Repositories\UserRepositoryInterface;
use App\Http\Requests\LoginRequest;
use App\Traits\Responses\FormatsAuthErrorResponses;
use App\Traits\Responses\FormatsLoginResponse;

class LoginController extends Controller
{
    use FormatsAuthErrorResponses,
        FormatsLoginResponse;

    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request): Response
    {
        // check validity
        if (! $this->repository->loginCredentialsMatch(
            $request->validated('email'),
            $request->validated('password')
        )) {
            throw $this->loginFailed();
        }

        // fetch user
        $user = $this->repository->findByEmail($request->validated('email'));

        // generate token
        $loginToken = $user->createToken('login');

        return $this->loggedInSuccessfully(
            user: $user,
            token: $loginToken->plainTextToken
        );
    }
}

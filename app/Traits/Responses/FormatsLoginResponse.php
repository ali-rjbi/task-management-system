<?php

namespace App\Traits\Responses;

use Illuminate\Http\Response;
use App\Http\Resources\UserResource;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

trait FormatsLoginResponse
{
    public function loggedInSuccessfully(User $user, string $token): Response
    {
        return response([
            'user' => new UserResource($user),
            'token' => $token
        ], SymfonyResponse::HTTP_OK);
    }
}

<?php

namespace App\Traits\Responses;

use App\Traits\Responses\FormatsErrorResponses;

trait FormatsAuthErrorResponses
{
    use FormatsErrorResponses;

    public static string $registrationFailedMessage = 'The registration operation failed.';
    public static string $loginFailedMessage = 'The provided credentials don\'t match';

    public function registrationFailed()
    {
        throw $this->errorResponse(
            message: self::$registrationFailedMessage
        );
    }

    public function loginFailed()
    {
        throw $this->errorResponse(
            message: self::$loginFailedMessage
        );
    }
}

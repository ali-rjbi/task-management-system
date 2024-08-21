<?php

namespace App\Traits\Responses;

use Illuminate\Http\Response;
use App\Traits\Responses\FormatsSuccessResponses;

trait FormatsAuthResponses
{
    use FormatsSuccessResponses;

    public static string $registeredMessage = 'The registration is completed successfully.';

    public function registeredSuccessfully(): Response
    {
        return $this->successfulResponse(
            message: self::$registeredMessage
        );
    }
}

<?php

namespace App\Traits\Responses;

use App\Traits\Responses\FormatsErrorResponses;
use Symfony\Component\HttpFoundation\Response;

trait FormatsTaskErrorResponses
{
    use FormatsErrorResponses;

    public static string $notFoundMessage = 'The requested task does not exist.';
    public static string $deleteFailedMessage = 'The operation of deleting the requested task failed.';
    public static string $unauthorizedMessage = 'You are not authorized to modify this task!';

    public function taskNotFound()
    {
        throw $this->errorResponse(
            message: self::$notFoundMessage,
            code: Response::HTTP_NOT_FOUND
        );
    }

    public function taskWasNotDeleted()
    {
        throw $this->errorResponse(
            message: self::$deleteFailedMessage,
        );
    }

    public function unauthorizedToModifyTask()
    {
        throw $this->errorResponse(
            message: self::$unauthorizedMessage,
            code: Response::HTTP_UNAUTHORIZED
        );
    }
}

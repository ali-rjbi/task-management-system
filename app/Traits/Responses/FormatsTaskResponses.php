<?php

namespace App\Traits\Responses;

use App\Http\Resources\TaskResource;
use Illuminate\Http\Response;
use App\Traits\Responses\FormatsResourceResponses;
use App\Traits\Responses\FormatsSuccessResponses;

trait FormatsTaskResponses
{
    use FormatsResourceResponses,
        FormatsSuccessResponses;

    public static string $taskCreatedMessage = 'The task created successfully.';
    public static string $taskUpdatedMessage = 'The task updated successfully.';
    public static string $taskDeletedMessage = 'The task deleted successfully.';

    public function showTaskResponse($task): Response
    {
        return $this->singleResourceResponse(
            data: $task,
            apiResource: TaskResource::class
        );
    }

    public function paginatedTasksResponse($tasks): Response
    {
        return $this->paginatedResourcesResponse(
            data: $tasks,
            apiResource: TaskResource::class
        );
    }

    public function taskCreated($task): Response
    {
        return $this->singleResourceResponse(
            data: $task,
            message: self::$taskCreatedMessage,
            apiResource: TaskResource::class,
            code: Response::HTTP_CREATED
        );
    }

    public function taskUpdated($task): Response
    {
        return $this->singleResourceResponse(
            data: $task,
            message: self::$taskUpdatedMessage,
            apiResource: TaskResource::class
        );
    }

    public function taskDeleted(): Response
    {
        return $this->successfulResponse(
            message: self::$taskDeletedMessage,
        );
    }
}

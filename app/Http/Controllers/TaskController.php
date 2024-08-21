<?php

namespace App\Http\Controllers;

use App\Http\Requests\FetchTasksRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Services\TaskService;
use App\Traits\Responses\FormatsTaskErrorResponses;
use App\Traits\Responses\FormatsTaskResponses;
use Exception;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    use FormatsTaskResponses, FormatsTaskErrorResponses;

    /**
     * Constructor to initialize the TaskService.
     *
     * @param TaskService $taskService
     */
    public function __construct(private TaskService $taskService)
    {
    }

    /**
     * Display a paginated list of tasks.
     *
     * @param FetchTasksRequest $request
     * @return Response
     */
    public function index(FetchTasksRequest $request): Response
    {
        return $this->paginatedTasksResponse(
            tasks: $this->taskService->getTasks(
                params: $request->validated(),
                perPage: $request->validated('perPage', 15)
            )
        );
    }


    /**
     * Get tasks for the authenticated user.
     */
    public function getUserTasks(FetchTasksRequest $request): Response
    {
        $tasks = $this->taskService->getTasks(
            params: ['user_id' => $request->user()->id],
            perPage: $request->validated('perPage',15)
        );

        return $this->paginatedTasksResponse($tasks);
    }

    /**
     * Display the specified task.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        return $this->showTaskResponse(
            $this->taskService->getTaskById($id)
        );
    }

    /**
     * Store a newly created task in storage.
     *
     * @param StoreTaskRequest $request
     * @return Response
     */
    public function store(StoreTaskRequest $request): Response
    {
        return $this->taskCreated(
            $this->taskService->createTask($request->validated())
        );
    }

    /**
     * Update the specified task in storage.
     *
     * @param StoreTaskRequest $request
     * @param int $id
     * @return Response
     */
    public function update(StoreTaskRequest $request, int $id): Response
    {
        return $this->taskUpdated(
            $this->taskService->updateTask($id, $request->validated()),
        );
    }

    /**
     * Remove the specified task from storage.
     *
     * @param int $id
     * @return Response
     * @throws Exception
     */
    public function destroy(int $id): Response
    {
        $result = $this->taskService->deleteTask($id);

        if (!$result) {
            throw $this->taskWasNotDeleted();
        }

        return $this->taskDeleted();
    }
}

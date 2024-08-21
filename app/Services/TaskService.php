<?php

namespace App\Services;

use App\Contracts\Repositories\TaskRepositoryInterface;
use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;
use Illuminate\Support\Facades\Gate;

class TaskService
{
    protected TaskRepositoryInterface $taskRepository;

    /**
     * Constructor to initialize the TaskRepositoryInterface.
     *
     * @param TaskRepositoryInterface $taskRepository
     */
    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    /**
     * Get a paginated list of tasks based on the given parameters.
     *
     * @param array $params
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getTasks(array $params, int $perPage): LengthAwarePaginator
    {
        return $this->taskRepository->getAndSearch($params, $perPage);
    }


    /**
     * Find a task by its ID.
     *
     * @param int $id
     * @return Task|null
     * @throws ModelNotFoundException
     */
    public function getTaskById(int $id): ?Task
    {
        return $this->taskRepository->findById($id);
    }

    /**
     * Create a new task.
     *
     * @param array $data
     * @return Task
     */
    public function createTask(array $data): Task
    {
        return $this->taskRepository->create($data);
    }

    /**
     * Update an existing task.
     *
     * @param int $taskId
     * @param array $data
     * @return bool
     * @throws ModelNotFoundException
     */
    public function updateTask(int $taskId, array $data): bool
    {
        $task = $this->taskRepository->findById($taskId);

        Gate::authorize('update', $task);

        if (!$task) {
            throw new ModelNotFoundException("Task not found with ID: {$taskId}");
        }

        return $this->taskRepository->update($task, $data);
    }

    /**
     * Delete a task.
     *
     * @param int $taskId
     * @return bool|null
     * @throws ModelNotFoundException
     * @throws Exception
     */
    public function deleteTask(int $taskId): ?bool
    {
        $task = $this->taskRepository->findById($taskId);

        Gate::authorize('delete', $task);

        if (!$task) {
            throw new ModelNotFoundException("Task not found with ID: {$taskId}");
        }

        return $this->taskRepository->delete($task);
    }
}

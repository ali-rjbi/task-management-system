<?php

namespace App\Contracts\Repositories;

use App\Models\Task;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface TaskRepositoryInterface
{
    /**
     * get a paginated list of tasks by providing params
     *
     * @param array $params
     * @param int $perPage
     */
    public function getAndSearch(array $params, int $perPage): LengthAwarePaginator;

    /**
     * Find a specific task by its ID.
     *
     * @param int $id
     * @return Task|null
     * @throws ModelNotFoundException
     */
    public function findById(int $id): ?Task;

    /**
     * Create a new task in the repository.
     *
     * @param array $data
     * @return Task
     */
    public function create(array $data): Task;

    /**
     * Update an existing task in the repository.
     *
     * @param Task $task
     * @param array $data
     * @return bool
     */
    public function update(Task $task, array $data): bool;

    /**
     * Delete a task from the repository.
     *
     * @param Task $task
     * @return bool|null
     * @throws Exception
     */
    public function delete(Task $task): ?bool;

    /**
     * determines weather the task with id exists in repository
     *
     * @param int $id
     * @return bool
     */
    public function exists(int $id): bool;
}

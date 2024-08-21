<?php

namespace App\Repositories;

use App\Contracts\Repositories\TaskRepositoryInterface;
use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class TaskRepository implements TaskRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function getAndSearch(array $params, int $perPage): LengthAwarePaginator
    {
        $query = Task::query()->with(['user','status','priority']);

        // Apply filters based on params
        if (isset($params['status'])) {
            $query->where('status_id', $params['status']);
        }

        if (isset($params['due_date'])) {
            $query->whereDate('due_date', $params['due_date']);
        }

        if (isset($params['user_id'])) {
            $query->where('user_id', $params['user_id']);
        }

        return $query
            ->latest()
            ->paginate($perPage);
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id): ?Task
    {
        return Task::with(['user','status','priority'])->find($id);
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): Task
    {
        return Task::create($data);
    }

    /**
     * @inheritDoc
     */
    public function update(Task $task, array $data): bool
    {
        return $task->update($data);
    }

    /**
     * @inheritDoc
     */
    public function delete(Task $task): ?bool
    {
        try {
            return $task->delete();
        } catch (Exception $e) {
            throw new Exception("Error deleting task: " . $e->getMessage());
        }
    }

    /**
     * @inheritDoc
     */
    public function exists(int $id): bool
    {
        return Task::where('id', $id)->exists();
    }
}

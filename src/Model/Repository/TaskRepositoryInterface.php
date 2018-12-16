<?php

namespace App\Model\Repository;

use App\Model\Task;

/**
 * Interface TaskRepositoryInterface
 * @package App\Model\Repository
 */
interface TaskRepositoryInterface
{
    /**
     * @param int $taskId
     * @return Task
     */
    public function findById(int $taskId): ?Task;

    /**
     * @param Task $task
     */
    public function save(Task $task): void;

    /**
     * @param Task $task
     */
    public function delete(Task $task): void;
}
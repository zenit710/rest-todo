<?php

namespace App\Service;

use App\Entity\Task;

/**
 * Interface TaskServiceInterface
 * @package App\Service
 */
interface TaskServiceInterface
{
    /**
     * @param array $data
     * @return Task
     */
    public function add(array $data): Task;

    /**
     * @param Task $task
     */
    public function delete(Task $task);

    /**
     * @param int $taskId
     * @return Task|null
     */
    public function find(int $taskId);

    /**
     * @param Task $task
     * @param array $data
     * @return Task
     */
    public function update(Task $task, array $data): Task;
}
<?php

namespace App\Model\Service;

use App\Model\Task;

/**
 * Interface TaskServiceInterface
 * @package App\Model\Service
 */
interface TaskServiceInterface
{
    /**
     * @param array $data
     * @return Task
     */
    public function add(array $data): Task;

    /**
     * @param int $taskId
     */
    public function delete(int $taskId);

    /**
     * @param int $taskId
     * @return Task|null
     */
    public function find(int $taskId);

    /**
     * @param int $taskId
     * @param array $data
     * @return Task
     */
    public function update(int $taskId, array $data): Task;
}
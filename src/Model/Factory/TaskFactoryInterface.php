<?php

namespace App\Model\Factory;

use App\Model\Task;

/**
 * Interface TaskFactoryInterface
 * @package App\Model\Factory
 */
interface TaskFactoryInterface
{
    /**
     * @param array $data
     * @return Task
     */
    public function create(array $data): Task;
}
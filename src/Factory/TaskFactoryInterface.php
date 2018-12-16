<?php

namespace App\Factory;

use App\Entity\Task;

/**
 * Interface TaskFactoryInterface
 * @package App\Factory
 */
interface TaskFactoryInterface
{
    /**
     * @param array $data
     * @return Task
     */
    public function create(array $data): Task;
}
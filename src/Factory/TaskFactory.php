<?php

namespace App\Factory;

use App\Model\Factory\TaskFactoryInterface;
use App\Model\Service\CategoryServiceInterface;
use App\Model\Task;

/**
 * Class TaskFactory
 * @package App\Factory
 */
class TaskFactory implements TaskFactoryInterface
{
    /**
     * @var CategoryServiceInterface
     */
    private $categoryService;

    /**
     * TaskFactory constructor.
     * @param CategoryServiceInterface $categoryService
     */
    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @inheritdoc
     */
    public function create(array $data): Task
    {
        $task = new Task();

        $task->setName($data['name']);
        $task->setCategory($this->categoryService->find($data['categoryId']));
        $task->setDueDate(new \DateTime($data['dueDate']));

        return $task;
    }
}
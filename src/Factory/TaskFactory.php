<?php

namespace App\Factory;

use App\Entity\Task;
use App\Repository\CategoryRepository;

/**
 * Class TaskFactory
 * @package App\Factory
 */
class TaskFactory implements TaskFactoryInterface
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * TaskFactory constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @inheritdoc
     */
    public function create(array $data): Task
    {
        $task = new Task();

        $task->setName($data['name']);
        $task->setCategory($this->categoryRepository->find($data['categoryId']));
        $task->setDueDate(new \DateTime($data['dueDate']));

        return $task;
    }
}
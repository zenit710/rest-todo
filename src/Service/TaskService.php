<?php

namespace App\Service;

use App\Model\Factory\TaskFactoryInterface;
use App\Model\Repository\TaskRepositoryInterface;
use App\Model\Service\TaskServiceInterface;
use App\Model\Task;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class TaskService
 * @package App\Service
 */
class TaskService implements TaskServiceInterface
{
    /**
     * @var TaskRepositoryInterface
     */
    private $taskRepository;

    /**
     * @var TaskFactoryInterface
     */
    private $taskFactory;

    /**
     * TaskService constructor.
     * @param TaskRepositoryInterface $taskRepository
     * @param TaskFactoryInterface $taskFactory
     */
    public function __construct(TaskRepositoryInterface $taskRepository, TaskFactoryInterface $taskFactory)
    {
        $this->taskRepository = $taskRepository;
        $this->taskFactory = $taskFactory;
    }

    /**
     * @inheritdoc
     */
    public function add(array $data): Task
    {
        $task = $this->taskFactory->create($data);

        $this->taskRepository->save($task);

        return $task;
    }

    /**
     * @inheritdoc
     */
    public function delete(int $taskId)
    {
        $task = $this->find($taskId);

        $this->taskRepository->delete($task);
    }

    /**
     * @inheritdoc
     */
    public function find(int $taskId)
    {
        $task = $this->taskRepository->findById($taskId);

        if (!$task) {
            throw new EntityNotFoundException('Task with id ' . $taskId . ' does not exist!');
        }

        return $task;
    }

    /**
     * @inheritdoc
     */
    public function update(int $taskId, array $data): Task
    {
        $task = $this->find($taskId);

        $updatedTask = $this->taskFactory->create($data);
        $task->setName($updatedTask->getName());
        $task->setCategory($updatedTask->getCategory());
        $task->setDueDate($updatedTask->getDueDate());
        $task->setStatus($data['status']);

        $this->taskRepository->save($task);

        return $task;
    }
}
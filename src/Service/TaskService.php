<?php

namespace App\Service;

use App\Entity\Task;
use App\Factory\TaskFactoryInterface;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class TaskService
 * @package App\Service
 */
class TaskService implements TaskServiceInterface
{
    /**
     * @var TaskRepository
     */
    private $taskRepository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var TaskFactoryInterface
     */
    private $taskFactory;

    /**
     * TaskService constructor.
     * @param TaskRepository $taskRepository
     * @param EntityManagerInterface $entityManager
     * @param TaskFactoryInterface $taskFactory
     */
    public function __construct(
        TaskRepository $taskRepository,
        EntityManagerInterface $entityManager,
        TaskFactoryInterface $taskFactory)
    {
        $this->taskRepository = $taskRepository;
        $this->entityManager = $entityManager;
        $this->taskFactory = $taskFactory;
    }

    /**
     * @inheritdoc
     */
    public function add(array $data): Task
    {
        $task = $this->taskFactory->create($data);

        $this->entityManager->persist($task);
        $this->entityManager->flush();

        return $task;
    }

    /**
     * @inheritdoc
     */
    public function delete(Task $task)
    {
        $this->entityManager->remove($task);
        $this->entityManager->flush();
    }

    /**
     * @inheritdoc
     */
    public function find(int $taskId)
    {
        return $this->taskRepository->find($taskId);
    }

    /**
     * @inheritdoc
     */
    public function update(Task $task, array $data): Task
    {
        $updatedTask = $this->taskFactory->create($data);
        $task->setName($updatedTask->getName());
        $task->setCategory($updatedTask->getCategory());
        $task->setDueDate($updatedTask->getDueDate());
        $task->setStatus($updatedTask->getStatus());

        $this->entityManager->flush();

        return $task;
    }
}
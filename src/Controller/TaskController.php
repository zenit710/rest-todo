<?php

namespace App\Controller;

use App\Entity\Task;
use App\Repository\CategoryRepository;
use App\Repository\TaskRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TaskController
 * @package App\Controller
 */
class TaskController extends FOSRestController
{
    /**
     * @var TaskRepository
     */
    private $taskRepository;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * TaskController constructor.
     * @param TaskRepository $taskRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(TaskRepository $taskRepository, CategoryRepository $categoryRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @Rest\Get("/tasks/{taskId}")
     * @param int $taskId
     * @return View
     */
    public function getTask(int $taskId): View
    {
        $task = $this->taskRepository->find($taskId);

        return new View($task, Response::HTTP_OK);
    }

    /**
     * @Rest\Delete("tasks/{taskId}")
     * @param int $taskId
     * @return View
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteTask(int $taskId): View
    {
        $task = $this->taskRepository->find($taskId);

        if ($task) {
            $this->taskRepository->delete($task);
        }

        return new View([], Response::HTTP_NO_CONTENT);
    }

    /**
     * @Rest\Patch("/tasks/{taskId}")
     * @param int $taskId
     * @param Request $request
     * @return View
     */
    public function patchTask(int $taskId, Request $request): View
    {
        $task = $this->taskRepository->find($taskId);

        if ($task) {
            $task->setStatus($request->get('status'));
        }

        return new View($task, Response::HTTP_CREATED);
    }

    /**
     * @Rest\Post("/tasks")
     * @param Request $request
     * @return View
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function postTask(Request $request): View
    {
        $category = $this->categoryRepository->find($request->get('categoryId'));

        if ($category) {
            $task = new Task();
            $task->setName($request->get('name'));
            $task->setCategory($category);
            $task->setDueDate(new \DateTime($request->get('dueDate')));
            $this->taskRepository->save($task);
        }

        return new View($task, Response::HTTP_CREATED);
    }

    /**
     * @Rest\Put("/tasks/{taskId}")
     * @param int $taskId
     * @param Request $request
     * @return View
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function putTask(int $taskId, Request $request): View
    {
        $task = $this->taskRepository->find($taskId);
        $category = $this->categoryRepository->find($request->get('categoryId'));

        if ($task && $category) {
            $task->setName($request->get('name'));
            $task->setCategory($category);
            $task->setDueDate(new \DateTime($request->get('dueDate')));
            $task->setStatus($request->get('status'));
            $this->taskRepository->save($task);
        }

        return new View($task, Response::HTTP_OK);
    }
}
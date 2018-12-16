<?php

namespace App\Controller;

use App\Model\Service\TaskServiceInterface;
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
     * @var TaskServiceInterface
     */
    private $taskService;

    /**
     * TaskController constructor.
     * @param TaskServiceInterface $taskService
     */
    public function __construct(TaskServiceInterface $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * @Rest\Get("/tasks/{taskId}")
     * @param int $taskId
     * @return View
     */
    public function getTask(int $taskId): View
    {
        $task = $this->taskService->find($taskId);

        return new View($task, Response::HTTP_OK);
    }

    /**
     * @Rest\Delete("tasks/{taskId}")
     * @param int $taskId
     * @return View
     */
    public function deleteTask(int $taskId): View
    {
        $this->taskService->delete($taskId);

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
        $task = $this->taskService->find($taskId);

        if ($task) {
            $task->setStatus($request->get('status'));
        }

        return new View($task, Response::HTTP_OK);
    }

    /**
     * @Rest\Post("/tasks")
     * @param Request $request
     * @return View
     */
    public function postTask(Request $request): View
    {
        $task = $this->taskService->add([
            'name' => $request->get('name'),
            'categoryId' => $request->get('categoryId'),
            'dueDate' => $request->get('dueDate'),
        ]);

        return new View($task, Response::HTTP_CREATED);
    }

    /**
     * @Rest\Put("/tasks/{taskId}")
     * @param int $taskId
     * @param Request $request
     * @return View
     */
    public function putTask(int $taskId, Request $request): View
    {
        $task = $this->taskService->update($taskId, [
            'name' => $request->get('name'),
            'categoryId' => $request->get('categoryId'),
            'dueDate' => $request->get('dueDate'),
            'status' => $request->get('status'),
        ]);

        return new View($task, Response::HTTP_OK);
    }
}
<?php

namespace App\Controller;

use App\Model\Service\CategoryServiceInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CategoryController
 * @package App\Controller
 */
class CategoryController extends FOSRestController
{
    /**
     * @var CategoryServiceInterface
     */
    private $categoryService;

    /**
     * CategoryController constructor.
     * @param CategoryServiceInterface $categoryService
     */
    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * @Rest\Get("/categories/{categoryId}")
     * @param int $categoryId
     * @return View
     */
    public function getCategory(int $categoryId): View
    {
        $category = $this->categoryService->find($categoryId);

        return new View($category, Response::HTTP_OK);
    }

    /**
     * @Rest\Delete("categories/{categoryId}")
     * @param int $categoryId
     * @return View
     */
    public function deleteCategory(int $categoryId): View
    {
        $this->categoryService->delete($categoryId);

        return new View([], Response::HTTP_NO_CONTENT);
    }

    /**
     * @Rest\Post("/categories")
     * @param Request $request
     * @return View
     */
    public function postCategory(Request $request): View
    {
        $category = $this->categoryService->add([
            'name' => $request->get('name'),
        ]);

        return new View($category, Response::HTTP_CREATED);
    }

    /**
     * @Rest\Put("/categories/{categoryId}")
     * @param int $categoryId
     * @param Request $request
     * @return View
     */
    public function putCategory(int $categoryId, Request $request): View
    {
        $category = $this->categoryService->update($categoryId, [
            'name' => $request->get('name'),
        ]);

        return new View($category, Response::HTTP_OK);
    }
}
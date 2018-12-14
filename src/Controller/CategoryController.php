<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
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
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * CategoryController constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @Rest\Get("/categories/{categoryId}")
     * @param int $categoryId
     * @return View
     */
    public function getCategory(int $categoryId): View
    {
        $category = $this->categoryRepository->find($categoryId);

        return new View($category, Response::HTTP_OK);
    }

    /**
     * @Rest\Delete("categories/{categoryId}")
     * @param int $categoryId
     * @return View
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteCategory(int $categoryId): View
    {
        $category = $this->categoryRepository->find($categoryId);

        if ($category) {
            $this->categoryRepository->delete($category);
        }

        return new View([], Response::HTTP_NO_CONTENT);
    }

    /**
     * @Rest\Post("/categories")
     * @param Request $request
     * @return View
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function postCategory(Request $request): View
    {
        $category = new Category();
        $category->setName($request->get('name'));
        $this->categoryRepository->save($category);

        return new View($category, Response::HTTP_CREATED);
    }

    /**
     * @Rest\Put("/categories/{categoryId}")
     * @param int $categoryId
     * @param Request $request
     * @return View
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function putCategory(int $categoryId, Request $request): View
    {
        $category = $this->categoryRepository->find($categoryId);

        if ($category) {
            $category->setName($request->get('name'));
            $this->categoryRepository->save($category);
        }

        return new View($category, Response::HTTP_OK);
    }
}
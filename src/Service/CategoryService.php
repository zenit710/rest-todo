<?php

namespace App\Service;

use App\Model\Category;
use App\Model\Factory\CategoryFactoryInterface;
use App\Model\Repository\CategoryRepositoryInterface;
use App\Model\Service\CategoryServiceInterface;
use Doctrine\ORM\EntityNotFoundException;

/**
 * Class CategoryService
 * @package App\Service
 */
class CategoryService implements CategoryServiceInterface
{
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;

    /**
     * @var CategoryFactoryInterface
     */
    private $categoryFactory;

    /**
     * CategoryService constructor.
     * @param CategoryRepositoryInterface $categoryRepository
     * @param CategoryFactoryInterface $categoryFactory
     */
    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        CategoryFactoryInterface $categoryFactory)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryFactory = $categoryFactory;
    }

    /**
     * @inheritdoc
     */
    public function add(array $data): Category
    {
        $category = $this->categoryFactory->create($data);

        $this->categoryRepository->save($category);

        return $category;
    }

    /**
     * @inheritdoc
     */
    public function delete(int $categoryId)
    {
        $category = $this->find($categoryId);

        $this->categoryRepository->delete($category);
    }

    /**
     * @inheritdoc
     */
    public function find(int $categoryId)
    {
        $category = $this->categoryRepository->findById($categoryId);

        if (!$category) {
            throw new EntityNotFoundException('Category with id ' . $categoryId . ' does not exist!');
        }

        return $category;
    }

    /**
     * @inheritdoc
     */
    public function update(int $categoryId, array $data): Category
    {
        $category = $this->find($categoryId);
        $category->setName($data['name']);

        $this->categoryRepository->save($category);

        return $category;
    }
}
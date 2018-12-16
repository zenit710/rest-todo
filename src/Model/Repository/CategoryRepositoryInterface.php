<?php

namespace App\Model\Repository;

use App\Model\Category;

/**
 * Interface CategoryRepositoryInterface
 * @package App\Repository
 */
interface CategoryRepositoryInterface
{
    /**
     * @param int $categoryId
     * @return Category
     */
    public function findById(int $categoryId): ?Category;
    
    /**
     * @param Category $category
     */
    public function save(Category $category): void;
    
    /**
     * @param Category $category
     */
    public function delete(Category $category): void;
}
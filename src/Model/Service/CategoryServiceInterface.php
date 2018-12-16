<?php

namespace App\Model\Service;

use App\Model\Category;

/**
 * Interface CategoryServiceInterface
 * @package App\Model\Service
 */
interface CategoryServiceInterface
{
    /**
     * @param array $data
     * @return Category
     */
    public function add(array $data): Category;

    /**
     * @param int $categoryId
     */
    public function delete(int $categoryId);

    /**
     * @param int $categoryId
     * @return Category|null
     */
    public function find(int $categoryId);

    /**
     * @param int $categoryId
     * @param array $data
     * @return Category
     */
    public function update(int $categoryId, array $data): Category;
}
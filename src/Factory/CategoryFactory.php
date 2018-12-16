<?php

namespace App\Factory;

use App\Model\Category;
use App\Model\Factory\CategoryFactoryInterface;

/**
 * Class CategoryFactory
 * @package App\Factory
 */
class CategoryFactory implements CategoryFactoryInterface
{
    /**
     * @inheritdoc
     */
    public function create(array $data): Category
    {
        $category = new Category();
        $category->setName($data['name']);

        return $category;
    }
}
<?php

namespace App\Model\Factory;

use App\Model\Category;

/**
 * Interface CategoryFactoryInterface
 * @package App\Model\Factory
 */
interface CategoryFactoryInterface
{
    /**
     * @param array $data
     * @return Category
     */
    public function create(array $data): Category;
}
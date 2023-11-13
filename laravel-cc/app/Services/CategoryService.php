<?php

namespace App\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;

class CategoryService
{
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function createCategory(array $categoryData): Category
    {

        return $this->categoryRepository->createCategory($categoryData);
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->getAllCategories();
    }
}

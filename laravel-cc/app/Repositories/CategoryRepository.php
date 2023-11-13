<?php

namespace App\Repositories;

use App\Models\Category;
use App\Services\CacheManager;
use Illuminate\Support\Collection;

class CategoryRepository
{
    protected $cacheManager;

    public function __construct(CacheManager $cacheManager)
    {
        $this->cacheManager = $cacheManager;
    }

    public function getAllCategories(): Collection
    {
        $categoriesCache = $this->cacheManager->get('categories');
        if (!$categoriesCache) {
            $categories = Category::all();
            $categoriesCache = $this->cacheManager->put('categories', $categories, 60);
        } else {
            $categories = $categoriesCache;
        }

        return $categories;
    }

    public function getCategoryById(int $categoryId): Category
    {
        $categoryCache = $this->cacheManager->get("categories_$categoryId");
        if (!$categoryCache) {
            $category = Category::findOrFail($categoryId);
            $categoryCache = $this->cacheManager

                ->put("categories_$categoryId", $category, 60);
        } else {
            $category = $categoryCache;
        }

        return $category;
    }

    public function createCategory(array $categoryData): Category
    {
        $category = Category::create($categoryData);
        $categoryId = $category->id;
        $this->cacheManager

            ->put("category_$categoryId", $category, 60);

        return $category;
    }

    public function updateCategory(int $categoryId, array $categoryData): void
    {
        $category = Category::findOrFail($categoryId);
        $category->update($categoryData);
        $categoryId = $category->id;

        $this->cacheManager
            ->put("category_$categoryId", $category, 60);
    }

    public function deleteCategory(int $categoryId): void
    {
        Category::findOrFail($categoryId)->delete();
        $this->cacheManager->delete("category_$categoryId");
    }
}

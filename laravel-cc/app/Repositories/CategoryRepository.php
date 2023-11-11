<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Support\Collection;

class CategoryRepository
{
    public function getAllCategories(): Collection
    {
        return Category::all();
    }

    public function getCategoryById(int $categoryId): Category
    {
        return Category::findOrFail($categoryId);
    }

    public function createCategory(array $categoryData): Category
    {
        return Category::create($categoryData);
    }

    public function updateCategory(int $categoryId, array $categoryData): void
    {
        $category = Category::findOrFail($categoryId);
        $category->update($categoryData);
    }

    public function deleteCategory(int $categoryId): void
    {
        Category::findOrFail($categoryId)->delete();
    }
}

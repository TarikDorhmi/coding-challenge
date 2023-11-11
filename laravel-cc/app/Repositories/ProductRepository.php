<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Collection;

class ProductRepository
{
    public function getAllProducts(): Collection
    {
        return Product::all();
    }

    public function getProductById(int $productId): Product
    {
        return Product::findOrFail($productId);
    }

    public function createProduct(array $productData): Product
    {
        return Product::create($productData);
    }

    public function updateProduct(int $productId, array $productData): void
    {
        $product = Product::findOrFail($productId);
        $product->update($productData);
    }

    public function deleteProduct(int $productId): void
    {
        Product::findOrFail($productId)->delete();
    }
}

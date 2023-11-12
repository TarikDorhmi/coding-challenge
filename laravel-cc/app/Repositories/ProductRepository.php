<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Cache\CacheManager;

class ProductRepository
{

    public function getAllProducts($categoryId = null, $sortByPrice = false, $order = 'asc'): Collection
    {
        $cacheManager = app(CacheManager::class);

        if ($categoryId) {
            $products = Product::join('category_product', 'products.id', '=', 'category_product.product_id')
                ->where('category_product.category_id', $categoryId)
                ->select('products.*')
                ->get();
        } else {
            $products = Product::all();
        }
        if ($sortByPrice) {
            $products = $products->sortBy('price', $sortByPrice, $order);
        }

        return $products;
    }

    public function getProductById(int $productId): Product
    {
        return Product::findOrFail($productId);
    }

    public function createProduct(array $productData): Product
    {

        $product = Product::create($productData);

        // * Attach the category if provided
        if ($productData['category_id']) {
            $product->categories()->sync($productData['category_id']);
        }

        return $product;
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

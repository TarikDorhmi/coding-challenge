<?php

namespace App\Repositories;

use App\Models\Product;
use App\Services\CacheManager;
use Illuminate\Support\Collection;

class ProductRepository
{
    protected $cacheManager;
    private $eagerLoading;

    public function __construct(CacheManager $cacheManager, $eagerLoading = false)
    {
        $this->cacheManager = $cacheManager;
        $this->eagerLoading = $eagerLoading;
    }

    public function getAllProducts($categoryId = null, $sortByPrice = false, $order = 'asc'): Collection
    {
        if ($categoryId) {
            $productsCache = $this->cacheManager->get("products_$categoryId");
            if (!$productsCache) {
                if ($this->eagerLoading) {
                    $products = Product::with('categories')->get();
                } else {
                    $products = Product::join('category_product', 'products.id', '=', 'category_product.product_id')
                        ->where('category_product.category_id', $categoryId)
                        ->select('products.*')
                        ->take(100)
                        ->get();
                }

                $this->cacheManager->put("products_$categoryId", $products, 60);
            } else {
                $products = $productsCache;
            }
        } else {
            $productsCache = $this->cacheManager->get('products');
            if (!$productsCache) {
                $products = Product::orderBy('created_at', 'desc')->take(100)->get();
                $this->cacheManager->put('products', $products, 60);
            } else {
                $products = $productsCache;
            }
        }
        if ($sortByPrice) {
            $productsCaches = $this->cacheManager->get("products_$order" . '_price');
            if (!$productsCaches) {
                $productsCaches = $this->cacheManager->put("products_$order" . '_price', $products, 60);
                $products = $productsCaches;
            } else {
                $products = $products->sortBy('price', $sortByPrice, $order);
            }
        }

        return $products;
    }

    public function getProductById(int $productId): Product
    {
        $product = $this->cacheManager->get("product_$productId");

        if (!$product) {
            $product = Product::find($productId);

            $this->cacheManager->put("product_$productId", $product, 60);
        }

        return Product::findOrFail($productId);
    }

    public function createProduct(array $productData): Product
    {

        $product = Product::create($productData);

        // * Attach the category if provided
        if (isset($productData['category_id'])) {
            $product->categories()->sync($productData['category_id']);
        }
        $productId = $product->id;

        $this->cacheManager->put("product_$productId", $product, 60);

        return $product;
    }

    public function updateProduct(int $productId, array $productData): void
    {
        $product = Product::findOrFail($productId);
        $product->update($productData);
        $productId = $product->id;
        $this->cacheManager->put("product_$productId", $product, 60);

    }

    public function deleteProduct(int $productId): void
    {
        Product::findOrFail($productId)->delete();
        $this->cacheManager->delete("product_$productId");

    }
}

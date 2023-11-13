<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;

class ProductService
{
    private $productRepository;
    private $fileManagerService;
    private $productValidationService;

    public function __construct(ProductRepository $productRepository, FileManagerService $fileManagerService, ProductValidationService $productValidationService)
    {
        $this->productRepository = $productRepository;
        $this->fileManagerService = $fileManagerService;
        $this->productValidationService = $productValidationService;
    }

    public function createProduct(array $productData): Product
    {
        $validationResult = $this->productValidationService->validate($productData);
        // * handle image upload
        if (isset($productData['image'])) {
            $imageBase64Data = $productData['image'];
            $imageFilename = $productData['name'] . '-' . time() . '.jpg';
            $imagePath = $this->fileManagerService
                ->uploadImage(
                    $imageBase64Data,
                    $imageFilename
                );
            unset($productData['image']);
            $productData['image'] = $imagePath;
        }

        return $this->productRepository->createProduct($productData);
    }

    public function getAllProducts($categoryId = null, $sortByPrice = false, $order = 'asc')
    {
        return $this->productRepository
            ->getAllProducts(
                $categoryId ?? null,
                $sortByPrice ?? false,
                $order ?? 'asc'
            );
    }

    public function getProductById($id)
    {
        return $this->productRepository->getProductById($id);
    }

    public function updateProduct(int $productId, array $productData)
    {
        $product = $this->productRepository->getProductById($productId);
        $validationResult = $this->productValidationService->validate($productData);

        $product->update($productData);

        return $product;
    }

    public function deleteProduct(int $productId)
    {
        $this->productRepository->deleteProduct($productId);
    }
}

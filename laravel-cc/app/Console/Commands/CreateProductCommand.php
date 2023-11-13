<?php

namespace App\Console\Commands;

use App\Services\ProductService;
use Illuminate\Console\Command;

class CreateProductCommand extends Command
{
    private $productService;
    protected $signature = 'product:create {name} {description} {price}';

    protected $description = 'Create a new product';

    public function __contruct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function handle()
    {
        $productData = [
            'name' => $this->argument('name'),
            'description' => $this->argument('description'),
            'price' => $this->argument('price'),
        ];

        $product = $this->productService->createProduct($productData);

        if ($product) {
            $this->info('Product created successfully.');
        } else {
            $this->error('Failed to create product.');
        }
    }
}

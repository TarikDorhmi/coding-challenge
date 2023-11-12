<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ProductService;

class CreateProductCommand extends Command
{
    protected $signature = 'product:create {name} {description} {price}';

    protected $description = 'Create a new product';

    public function handle(ProductService $productService)
    {
        $productData = [
            'name' => $this->argument('name'),
            'description' => $this->argument('description'),
            'price' => $this->argument('price'),
        ];

        $product = $productService->createProduct($productData);

        if ($product) {
            $this->info('Product created successfully.');
        } else {
            $this->error('Failed to create product.');
        }
    }
}

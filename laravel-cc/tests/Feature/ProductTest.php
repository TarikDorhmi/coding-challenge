<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    /** @test */
    public function a_product_can_be_created()
    {
        $response = $this->post('/api/products', [
            'name' => 'Test Product 2',
            'description' => 'This is a test product',
            'price' => 49.99,
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('products', [
            'name' => 'Test Product 2',
            'description' => 'This is a test product',
            'price' => 49.99,
        ]);
    }
}

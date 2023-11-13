<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class RestProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();

        return response()->json($products);
    }

    public function store(Request $request)
    {
        $product = $this->productService->createProduct($request->all());

        return response()->json($product, 201);
    }

    public function show($id)
    {
        $product = $this->productService->getProductById($id);

        return response()->json($product);
    }

    public function update(Request $request, $id)
    {
        $product = $this->productService->updateProduct($id, $request->all());

        return response()->json($product);
    }

    public function destroy($id)
    {
        $this->productService->deleteProduct($id);

        return response()->json(null, 204);
    }
}

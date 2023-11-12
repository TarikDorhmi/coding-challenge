<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Services\CategoryService;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoryId = null;
        // * the set test is done only for the normal listing
        if(isset($_GET['category_id'])){
            $categoryId = $_GET['category_id'];
        }
        $sort = false;
        if(isset($_GET['sort']) && !empty($_GET['sort'])){
            $sort = true;
        }
        $order = "asc";
        if(isset($_GET['order']) ){
            $order = $_GET['order'];
        }
        $productService = new ProductService();
        $products = $productService
            ->getAllProducts(
                $categoryId,
                $sort,
                $order
            );

        $categoryService = new CategoryService();
        $categories = $categoryService->getAllCategories();

        return view('web.products.list', compact(['products', 'categories']));
    }
    public function indexSPA()
    {
        return view('api.products.list');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoryService = new CategoryService();
        $categories = $categoryService->getAllCategories();

        return view('web.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $productData = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'category_id' => $request->input('categories')
        ];

        // * Handle image upload if present
        if ($request->hasFile('image')) {
            $imageFileName = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/products', $imageFileName);
            $productData['image'] = $imageFileName;
        }
        // *Instantiate the ProductService
        $productService = new ProductService();
        $product = $productService->createProduct($productData);
        return redirect()->route('products');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}

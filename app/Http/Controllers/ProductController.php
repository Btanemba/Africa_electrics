<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $categories = Category::has('products')->get();
        $products = Product::where('status', true)
            ->with(['category', 'images'])
            ->latest()
            ->paginate(12);

        return view('products.index', compact('products', 'categories'));
    }

    public function byCategory(Category $category)
    {
        $categories = Category::has('products')->get();
        $products = $category->products()
            ->where('status', true)
            ->with('images')
            ->latest()
            ->paginate(12);

        return view('products.index', compact('products', 'categories', 'category'));
    }

    public function show(Product $product)
    {
        $product->load(['category', 'images']);
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', true)
            ->with('images')
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}

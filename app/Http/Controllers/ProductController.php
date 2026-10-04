<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('sort_order')->get();
        return view('pages.products', compact('products'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $otherProducts = Product::where('id', '!=', $product->id)->get();
        return view('pages.product-detail', compact('product', 'otherProducts'));
    }
}

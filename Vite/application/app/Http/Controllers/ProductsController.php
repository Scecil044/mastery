<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductsController extends Controller
{
    public function index(){
        $products = Product::query()->orderBy('id', 'desc')->paginate(5);
        return view('products.index', compact('products'));
    }
    public function view(Product $product){
        return view('products.view',compact('product'));
    }
}

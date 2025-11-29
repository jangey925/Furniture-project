<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductDetailsController extends Controller
{
    public function showDetails($id)
    {
         $product = Product::with('category')->findOrFail($id);
        return view ('products.showdetails', compact('product'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display products under a specific category.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function index($id)
    {
        
         // Retrieve products by category ID
         $products = Product::where('category_id', $id)->get();
         // Check if products exist for the given category
          if ($products->isEmpty()) {
        return view('category.show', ['error' => 'No products available in this category.']);
    }

        // Pass the products to the view
        return view('category.show', compact('products'));
        // $category = Product::find($id);
          
    //    $categoryId = $id; // Assuming $id is the category ID you want to search for
    //    dd($categoryId);
        // $products = Product::where('category_id', $categoryId)->get();

        // print_r($products);
        // die;
        // dd($products->name);

        // if (!$products) {
        //     return view('category.show', ['error' => 'Category not found.']);
        // }

       
        // $products = $category->products; 

       
        // if ($products->isEmpty()) {
        //     return view('category.show', ['error' => 'No products found under this category.']);
        // }

        // // dd($products->id);
        // return view('category.show', compact('products'));
    }
    
}

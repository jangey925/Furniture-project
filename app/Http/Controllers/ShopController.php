<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;


class ShopController extends Controller
{
    //
        public function index()
    {
         $categories = Category::all();
        return view('shop.shop', compact('categories')); 
    }

     
}

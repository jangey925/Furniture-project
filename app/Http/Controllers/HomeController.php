<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class HomeController extends Controller
{
    //
    public function index()
    {

    //    $category = Category::all();
    //     return view('home', compact('category')); 
     
   
        $categories = Category::all(); 
        return view('home', compact('categories')); 
    }

    public function show($id)
    {
        $category = Category::findOrFail($id); 
        return view('category.bed', compact('category')); 
    }
  }


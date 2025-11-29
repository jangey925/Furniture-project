<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notification\NewProductAdded;
use App\Models\User;
use App\Models\Product;

class CustomerController extends Controller
{
    //
     public function index()
    {
        return view('customer.dashbord');      
    }

    public function addProduct(Request $request)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'price' => 'required|numeric|min:0',
    ]);

    $product = Product::create($validatedData);

    // Notify all users
    $users = User::all();
    foreach ($users as $user) {
        $user->notify(new NewProductAdded($product->name, url('/products/' . $product->id)));
    }

    return redirect()->route('category.show')->with('success', 'Product added and notifications sent.');
}

public function notify()
{
    $notifications = auth()->user()->notifications;
   // dd($notifications);
    //print_r($notifications); exit;
    return view('customer.notification', compact('notifications'));
}

}

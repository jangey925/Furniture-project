<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; 

class CartController extends Controller
{
    
    public function index()
    {
        return view('cart.index');
    }

   
    public function add(Request $request)
    {
        $product=$request->input('product');
        $id=$request->product_id;
        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }

    
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'product_id'=>$id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image, 
            ];
        }

      
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Item added to cart!');
    }


     public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
             $product = Product::find($id);

            if (!$product) {
                return redirect()->route('cart.index')->with('error', 'Product not found.');
            }

            
            if ($request->quantity > $product->quantity) {
                return redirect()->route('cart.index')->with('error', 'Sorry out of  stock.');
            }

            // Update the cart quantity
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);

            return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
        }

        return redirect()->route('cart.index')->with('error', 'Item not found in cart.');
    }


    // // Remove  from the cart
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Item removed from cart!');
    }
}

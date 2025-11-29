<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    // Display the checkout page
    public function index()
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to proceed to checkout.');
        }

        // Retrieve the cart from the session
        $cart = session()->get('cart', []);

        // Check if the cart is empty
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty. Please add some products first.');
        }

        // Return the checkout view with the cart data
        return view('cart.checkout', ['cart' => $cart]);
    }

    // Handle the checkout form submission
    public function processCheckout(Request $request)
    {
        // $user_id=Auth::id();
        // echo $user_id;
        // die;
        // dd($request);
        // Validate the input data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'province' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
            'heights.*' => 'nullable|string|max:255',
            'widths.*' => 'nullable|string|max:255',
        ]);

        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to complete the checkout.');
        }

        // Retrieve the cart from the session
        $cart = session()->get('cart', []);
// dd($cart);
        // Check if the cart is empty
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty. Please add some products first.');
        }

 // Retrieve customizations from the form
        $heights = $request->input('heights', []);
        $widths = $request->input('widths', []);

        // Loop through the cart items and create orders
        foreach ($cart as $key => $item) {
            $height = $heights[$key] ?? null;
            $width = $widths[$key] ?? null;

            // Calculate total price for the product
            $total = $item['price'] * $item['quantity'];

        // Loop through the cart items and create orders
        // foreach ($cart as $key => $item) {
            // $height = $heights[$key] ?? null;
            // $width = $widths[$key] ?? null;

            // if(isset($item['product_id'])) {
                
            //     try {
            //         echo "hi";
                    // die;
                    // Log the data being saved for debugging
                   
// print_r($item['quantity']);
// dd($request);
            // $total = $product->price * $item['quantity']; // Assuming the Product model has a price attribute

            // dd($total);
                    Order::create([
                        'product_id' => $item['product_id'],
                        'user_id'=> Auth::id(),
                        'name' => $request->input('name'),
                        'email' => $request->input('email'),
                        'phone' => $request->input('phone'),
                        'address' => $request->input('address'),
                        'province' => $request->input('province'),
                        'payment_method' => $request->input('payment_method'),
                        'quantity' => $item['quantity'],
                        'total' => $total,
                        'height' => $height,
                        'width' => $width,
                        // 'total' => '33',
                        // 'height' => '5',
                        // 'width' => '3',
                    ]);

                // } catch (\Exception $e) {
                //     Log::error('Order creation failed: ', [
                //         'error' => $e->getMessage(),
                //         'item' => $item,
                //         'request_data' => $request->all(),
                //     ]);
                //     return redirect()->route('cart.checkout')->with('error', 'There was an error processing your order.');
                // }
            }
        

        // Clear the cart after successful checkout
        //session()->forget('cart');

        // Redirect with success message
        return redirect()->route('cart.checkout')->with('success', 'Your order has been placed successfully!');
    
}

}
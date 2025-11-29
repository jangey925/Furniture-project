<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Notifications\NewProductAdded;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    
    public function create()
    {
        $categories = Category::all();  
        $products = Product::all();  
        return view('products.create', compact('categories', 'products'));
    }

    
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:20480',
        ]);

        
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public'); 
            $validated['image'] = $imagePath;  
        }

       
        $product = Product::create($validated);

        // Notify users about the new product
        $this->notifyUsers($product);

        // Redirect back to the create product page with a success message
        return redirect()->route('products.create')->with('success', 'Product added successfully!');
    }

    // Notify users about the new product
    public function notifyUsers(Product $product)
    {
        $users = User::all(); 

        foreach ($users as $user) {
            // Send the notification to each user
            try {
            $user->notify(new NewProductAdded(
                $product->name,
                $product->category_id,
                $product->id
            ));
        } catch (\Exception $e) {
            \Log::error("Notification failed: " . $e->getMessage());
        }
        }
    }

    // Search for products based on the query
    public function search(Request $request)
    {
        $query = $request->input('query');  

        // Find products matching the query in name or description
        $products = Product::where('name', 'LIKE', "%$query%")
            ->orWhere('description', 'LIKE', "%$query%")
            ->get();

        //return view('products.showdetails', compact('products', 'query'));
         return view('products.search_details', compact('products', 'query'));
    }

    // Show the edit form for a product
    public function edit($id)
    {
        $product = Product::findOrFail($id);  
        $categories = Category::all();  
        return view('products.edit', compact('product', 'categories'));
    }

    // Update a product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);  

    
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Update the product with the validated data
        $product->update($validatedData);

        // If a new image is uploaded, handle the file upload
        if ($request->hasFile('image')) {
            if ($product->image) {
                // Delete the old image if it exists
                Storage::disk('public')->delete($product->image);
            }

            // Store the new image and update the product record
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
            $product->save();
        }

        // Redirect back to the create product page with a success message
        return redirect()->route('products.create')->with('success', 'Product updated successfully!');
    }

    // Delete a product
    public function destroy(Product $product)
    {
        try {
            
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            // Delete the product from the database
            $product->delete();
            return redirect()->route('products.create')->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            // Log the error if there is an issue deleting the product
            \Log::error("Error deleting product image: " . $e->getMessage());
            return redirect()->route('products.create')->with('error', 'There was an issue deleting the product.');
        }
    }

    // Add a new product and notify users
    public function addProduct(Request $request)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
        ]);

    
        $product = Product::create($validatedData);

        // Notify users about the new product
        $this->notifyUsers($product);

        
        return redirect()->route('products.showdetails', ['id' => $product->category_id])
            ->with('success', 'Product added and customers notified.');
    }
}

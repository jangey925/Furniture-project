<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReplyToContact;
use App\Notifications\ReplyToCustomer;


use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
     public function index()
    {
       
     $totalProducts = Product::count(); 
      $totalContacts = Contact::count();
     $userRegistrations = User::where('role','customer')->count();
      //$totalOrders = Order::count();

        $totalOrders = Order::count();

 
    return view('admin.dashbord', compact('userRegistrations', 'totalProducts', 'totalContacts', 'totalOrders'));
        
    }

    public function show()
    {
        // Fetch all products
       $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users', compact('users'));
    }

   
public function showOrder()
{
   
  $orders = Order::with(['product', 'user'])->orderBy('created_at', 'desc')->get();


    return view('admin.orders', compact('orders'));
}

    public function showEmails($id = null)
{
    if ($id) {
        // Fetch the specific email
        $contact = Contact::findOrFail($id);
         $successMessage = session('success');
        return view('admin.mail_detail', compact('contact'));
    }

    // Fetch all emails
    $contacts = Contact::orderBy('created_at', 'desc')->get();
    return view('admin.mail', compact('contacts'));
}

public function sendReply(Request $request, $id)
{
    $request->validate([
        'replyMessage' => 'required|string|max:5000',
    ]);

    $contact = Contact::findOrFail($id);
    // Retrieve the contact's email address
     $contactEmail = $contact->email;
     $replyMessage = $request->replyMessage;
     $confirmationMessage = "Thank you for reaching out to us. Your inquiry has been addressed.";
   
     Mail::to($contactEmail)->send(new ReplyToContact($replyMessage , $confirmationMessage));
     Mail::to('bsnttshiva112@gmail.com')->send(new ReplyToContact($replyMessage , $confirmationMessage));
      // Send the notification to the customer
     //$contact->notify(new ReplyToContact($replyMessage, 'Reply from Admin'));
    
    return redirect()->route('admin.mail_detail' , ['id' => $id])
                     ->with('success', 'Reply sent successfully.');
}




    public function category()
    {
        $categories = Category::all(); 
        return view('admin.category', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            // allow larger uploads (20 MB) and validate image types
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
        ]);
         $imagePath = null;
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('category_images', 'public');
        }

        // Create the category
        Category::create([
            'name' => $request->name,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.category')->with('success', 'Category created successfully!');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.editcategory', compact('category'));
    }

    public function update(Request $request, $id)
    {
        // image should be optional on update and allow larger uploads (20 MB)
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:20480',
        ]);

        $category = Category::findOrFail($id);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the old image
            if ($category->image) {
                \Storage::disk('public')->delete($category->image);
            }

            $imagePath = $request->file('image')->store('category_images', 'public');
            $category->image = $imagePath;
        }

        $category->name = $request->name;
        $category->save();
        return redirect()->route('admin.category')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
         $category = Category::findOrFail($id);

        // Delete the associated image
        if ($category->image) {
            \Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('admin.category')->with('success', 'Category deleted successfully.');
    }
}

   
    


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    //
    public function index(){
        return view('contact.contact');
    }

     public function submit(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string|max:1000',
        ]);
          
        // Add user_id to the validated data
        $validatedData['user_id'] = auth()->id();
        
        // Store the contact information in the database
        Contact::create($validatedData);

        // Redirect with a success message
        return redirect()->route('contact.show')->with('success', 'Message sent successfully!');
    }
}

<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    // Display a listing of contact messages
    public function index()
    {
        $messages = ContactUs::all();
        return view('contact_us.index', compact('messages'));
    }

    // Show the form for creating a new contact message
    public function create()
    {
        return view('contact_us.create');
    }

    // Store a newly created contact message in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|string|max:15',
            'message' => 'required|string',
        ]);

        ContactUs::create($request->only([
            'name',
            'email',
            'phone',
            'message',
            'status',
        ]));

        return redirect()->back()->with('success', 'Your message has been sent successfully.');
    }

    // Display the specified contact message
    public function show(ContactUs $contactUs)
    {
        return view('contact_us.show', compact('contactUs'));
    }

    // Show the form for editing the specified contact message
    public function edit(ContactUs $contactUs)
    {
        return view('contact_us.edit', compact('contactUs'));
    }

    // Update the specified contact message in storage
    public function update(Request $request, ContactUs $contactUs)
    {
        $request->validate([
            'status' => 'required|in:new,in-progress,resolved',
        ]);

        $contactUs->update($request->only(['status']));

        return redirect()->route('contact_us.index')
                         ->with('success', 'Contact message updated successfully.');
    }

    // Remove the specified contact message from storage
    public function destroy(ContactUs $contactUs)
    {
        $contactUs->delete();

        return redirect()->route('contact_us.index')
                         ->with('success', 'Contact message deleted successfully.');
    }
}
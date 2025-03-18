<?php

namespace App\Http\Controllers;
use App\Models\ContactUs;
use App\Mail\ContactUsMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function index()
    {
        return view('pages.contactus');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Prepare email data
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
        ];

        // Save the contact message to the database
        try {
            ContactUs::create($data);
        } catch (\Exception $e) {
            // Handle potential errors during saving
            return redirect()->back()->with('error', 'Failed to save your message. Please try again later.');
        }
        // Send the email using the ContactUsMail class
        Mail::to('abod@bonfakhreldin.com')->send(new ContactUsMail($data));

        return redirect()->route('contactUs.index')->with('success', __('contactUs.message_sent'));
    }
}
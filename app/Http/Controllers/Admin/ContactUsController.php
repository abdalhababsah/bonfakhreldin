<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Display a listing of contact messages.
     */
    public function index()
    {
        // Fetch contact messages ordered from newest to oldest with pagination
        $messages = ContactUs::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.contactus.index', compact('messages'));
    }

    /**
     * Display the specified contact message.
     */
    public function show(ContactUs $contactUs)
    {
        return view('admin.contactus.show', compact('contactUs'));
    }

    /**
     * Remove the specified contact message from storage.
     */
    public function destroy(ContactUs $contactUs)
    {
        try {
            $contactUs->delete();
            return redirect()->route('admin.contact_us.index')
                             ->with('success', 'Contact message deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.contact_us.index')
                             ->with('error', 'An error occurred while deleting the contact message.');
        }
    }

    // Other methods (create, store, edit, update) can be omitted if not needed
}
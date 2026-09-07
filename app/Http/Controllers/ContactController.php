<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Show the contact form.
     */
    public function create()
    {
        return view('static.contact');
    }

    /**
     * Handle contact form submission.
     */
    public function store(StoreContactRequest $request)
    {
        // Store in DB
        Contact::create($request->validated());

        // Optionally send email (placeholder email address)
        // Mail::to('admin@example.com')->send(new \App\Mail\ContactMail($request->validated()));

        return redirect()->route('contact.create')->with('success', 'Your message has been sent successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessageReceived;
use App\Models\ContactSubmission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        $submission = ContactSubmission::create($validated);

        $recipient = config('frames.contact.email');

        if ($recipient) {
            Mail::to($recipient)->send(new ContactMessageReceived($submission));
        }

        return back()
            ->with('status', 'Message sent successfully. We will get back to you soon.')
            ->withFragment('contact');
    }
}

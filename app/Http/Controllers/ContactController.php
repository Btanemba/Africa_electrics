<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function submit(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:50'],
            'message' => ['required', 'string', 'max:3000'],
        ]);

        Mail::to(config('mail.contact_to', config('mail.from.address')))
            ->send(new ContactMessage($validated));

        return back()->with('contact_success', 'Thanks! Your message has been sent.');
    }
}

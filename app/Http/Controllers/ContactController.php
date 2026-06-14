<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        Mail::raw(
            "Name: {$request->name}\nEmail: {$request->email}\n\nMessage:\n{$request->message}",
            function ($mail) use ($request) {
                $mail->to('dspd27940@gmail.com') // CHANGE THIS
                     ->subject('New Contact Form Message - HomeShine');
            }
        );

        return back()->with('success', 'Message sent successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Mail\ContactUs;
use Illuminate\Http\Request;
use App\Events\ContactFormSubmitted;
use App\Livewire\Admin\NotificationBell;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message
        ];
        Mail::to($request->email)->send(new ContactUs($data));
        toastr()->success('A new mail has been sent to admins','Success');
        send_message_alert("Contact");
        return back();
    }
}

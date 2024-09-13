<?php

namespace App\Http\Controllers;

use App\Mail\EnquiryMail;
use Illuminate\Http\Request;
use Mail;

class FormController extends Controller
{
    public function sendEnquiry(Request $request){
        // dd($request->all());
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|regex:/^\+?[1-9]\d{1,14}$/', // Validate international phone numbers
            'from' => 'required|string|max:255',
            'to' => 'required|string|max:255',
            'number-of-people' => 'required|integer|min:1|max:1000', // Assuming a reasonable max limit
            'vehicle-type' => 'required|string|max:255',
            'start-date' => 'required|date|after_or_equal:today',
            'end-date' => 'required|date|after_or_equal:start-date',
            'message' => 'nullable|string|max:1000'
        ]);


        // Mail::to('info@darjeelingcab.in')->send(new EnquiryMail($validatedData));

        Mail::send('emails.enquiry', ['data' => $validatedData], function($message) {
            $message->to('info@darjeelingcab.in')
                    ->subject('New Enquiry from Website');
        });

        return response()->json('Enquiry sent successfully');
    }
}

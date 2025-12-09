<?php

namespace App\Http\Controllers;

use App\Mail\EnquiryMail;
use Illuminate\Http\Request;
use Mail;

class FormController extends Controller
{
    public function sendEnquiry(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|regex:/^\+?[1-9]\d{1,14}$/', // Validate international phone numbers
            'from' => 'required|string|max:255',
            'to' => 'required|string|max:255',
            'number-of-people' => 'required|integer|min:1|max:1000', // Assuming a reasonable max limit
            'vehicle-type' => 'required|string|max:255',
            'start-date' => 'required|date|after_or_equal:today',
            'end-date' => 'required|date|after_or_equal:start-date',
            'message' => 'nullable|string|max:1000',
            'g-recaptcha-response' =>'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        try {
            Mail::send('emails.enquiry', ['data' => $request->all()], function ($message) {
                $message->to('info@darjeelingcab.in')
                    ->subject('New Enquiry from Website');
            });

            Mail::send('emails.thank_you', [
                'name' => $request->input('name'),
                'from' => $request->input('from'),
                'to' => $request->input('to'),
                'numberOfPeople' => $request->input('number-of-people'),
                'vehicleType' => $request->input('vehicle-type'),
                'startDate' => $request->input('start-date'),
                'endDate' => $request->input('end-date'),
                'custom_message' => $request->input('message'),
            ], function ($message) use ($request) {
                $message->to($request->input('email'))
                    ->subject('Thank You for Your Enquiry');
            });

            return response()->json(['message' => 'Enquiry Submitted Successfully!'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'There was an error submitting your enquiry. Please try again.'], 500);
        }
    }

    public function contactUs(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|regex:/^\+?[1-9]\d{1,14}$/',
            'message' => 'required|string|max:1000',
            'g-recaptcha-response' => 'required',
        ]);

        try {
            Mail::send('emails.contact-form', ['data' => $request->all()], function ($message) {
                $message->to('info@darjeelingcab.in')
                    ->subject("New Enquiry from Website's Contact Form");
            });

            return back()->withSuccess('Enquiry Submitted Successfully!');
        } catch (\Exception $e) {
            return back()->withError('There was an error submitting your enquiry. Please try again.');
        }
    }
}

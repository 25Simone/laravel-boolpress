<?php

namespace App\Http\Controllers\Api;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // Save the form data in a variable and validate it
        $data = $request->validate([
            "name" => "required|string|min:3",
            "email" => "required|email",
            "message" => "required|string|min:10"
        ]);

        // Create a new line
        $newContact = new Contact();
        // Fill the contact width data
        $newContact->fill($data);
        // Save the line
        $newContact->save();

        // Return in json the newContact data
        return response()->json($newContact);
    }
}

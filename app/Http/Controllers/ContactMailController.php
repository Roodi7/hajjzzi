<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactMailRequest;
use App\Models\ContactMail;
use Illuminate\Http\Request;
use Mail;

class ContactMailController extends Controller
{
    //
    public function index()
    {
        $contactMails = ContactMail::all();
        return view('contact_mails.index', compact('contactMails'));
    }

    public function reply($id)
    {
        $contactMail = ContactMail::findOrFail($id);
        return view('contact_mails.reply', compact('contactMail'));
    }

    public function sendReply(Request $request, $id)
    {
        $request->validate([
            'replay' => 'required|string',
        ]);
        $email = ContactMail::findOrFail($id);
        $email->replay = $request->replay;
        $email->save();
        // Send the reply email

        $data = array('name' => $email->name, 'email' => $email->email, 'message' => $email->message, 'subject' => $email->subject, 'replay' => $email->replay);

        Mail::send(['text' => 'mail'], $data, function ($message) use ($data) {
            $message->to($data['email'], 'replay on ' . $data['subject'])->subject
            ('replay on ' . $data['subject'] . 'Hajzi Co');
            $message->from('info@hajjzi.com', 'Hajjzi Info');
        });


        return redirect()->route('contact-mails.index')->with('success', 'Reply sent successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contactMail = ContactMail::findOrFail($id);
        return response()->json($contactMail);
    }

    public function store(ContactMailRequest $request)
    {
        $contactMail = ContactMail::create($request->all());
        return response()->json($contactMail, 201);
    }

    public function update(ContactMailRequest $request, $id)
    {
        $contactMail = ContactMail::findOrFail($id);
        $contactMail->update($request->all());

        return response()->json($contactMail);
    }


    public function destroy($id)
    {
        $contactMail = ContactMail::findOrFail($id);
        $contactMail->delete();

        return response()->json(null, 204);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function create()
    {
        return view('contacts/create');
    }
    public function confirm(ContactRequest $request)
    {
        $contact = $request->only([
            'last_name', 'first_name','gender','email',
            'tel1', 'tel2', 'tel3', 'address',
            'building', 'category_id', 'detail',
        ]);

        return view('contacts/confirm', compact('contact'));
    }
    public function store(ContactRequest $request)
    {
        if($request->input('action') === 'back') {
            return redirect('/')->withInput();
        }

        $tel = $request->input('tel1') . '-' . $request->input('tel2') . '-' . $request->input('tel3');

        $contact = [
            'last_name' => $request->input('last_name'),
            'first_name' => $request->input('first_name'),
            'gender' => $request->input('gender'),
            'email' => $request->input('email'),
            'tel' => $tel,
            'address' => $request->input('address'),
            'building' => $request->input('building'),
            'category_id' => $request->input('category_id'),
            'detail' => $request->input('detail'),
        ];
        Contact::create($contact);
        return view('contacts/thanks');
    }
}

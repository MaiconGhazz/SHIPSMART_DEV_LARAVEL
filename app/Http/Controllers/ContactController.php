<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();

        return response()->json([
            'success' => true,
            'message' => 'List Semua Contact',
            'contacts' => $contacts
        ], 200);
    }

    public function create()
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required',
            'tel' => 'required',
            'cep' => 'required',
            'city' => 'required',
            'district' => 'required',
            'end' => 'required',
            'state' => 'required',
        ]);

        $contact = Contact::create([
            'name' => request('name'),
            'email' => request('email'),
            'tel' => request('tel'),
            'cep' => request('cep'),
            'city' => request('city'),
            'district' => request('district'),
            'end' => request('end'),
            'state' => request('state'),
        ]);


        return response()->json([
            'success' => true,
            'message' => 'Contact Created',
            'data' => $contact
        ], 201);
    }

    public function update($id)
    {
        request()
        ->merge(['id' => $id])
        ->validate([
            'name' => 'sometimes',
            'email' => 'sometimes',
            'tel' => 'sometimes',
            'cep' => 'sometimes',
            'city' => 'sometimes',
            'district' => 'sometimes',
            'end' => 'sometimes',
            'state' => 'sometimes',
            'id' => 'required',
        ]);

        $contact = Contact::find($id);

        $contact->update([
            'name' => request('name', $contact->name),
            'email' => request('email', $contact->email),
            'tel' => request('tel', $contact->tel),
            'cep' => request('cep', $contact->cep),
            'city' => request('city', $contact->city),
            'district' => request('district', $contact->district),
            'end' => request('end', $contact->end),
            'state' => request('state', $contact->state),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Contact Updated',
            'data' => $contact
        ], 201);
    }

    public function delete() {
        request()->validate([
            'id' => 'required',
        ]);

        $contact = Contact::destroy(request('id'));

        return response()->json([
            'success' => true,
            'message' => 'Contact deleted',
            'data' => $contact
        ], 201);
    }

    public function get($id) {
        request()->merge(['id' => $id])->validate([
            'id' => 'required',
        ]);

        $contact = Contact::find($id);

        return response()->json([
            'success' => true,
            'message' => 'Contact',
            'contact' => $contact
        ], 201);
    }
}

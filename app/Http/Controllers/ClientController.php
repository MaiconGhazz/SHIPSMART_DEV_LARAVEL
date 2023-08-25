<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();

        return response()->json([
            'success' => true,
            'message' => 'Clients',
            'contacts' => $clients
        ], 200);
    }

    public function create()
    {
        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255', 'in:cpf,cnpj'],
            'document' => ['required', 'string', 'max:255', Rule::unique('clients', 'document')],
        ]);

        $client = Client::create([
            'name' => request('name'),
            'type' => request('type'),
            'document' => request('document'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Client Created',
            'data' => $client
        ], 201);
    }

    public function update(Client $client)
    {
        request()->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'type' => ['sometimes', 'string', 'max:255', 'in:cpf,cnpj'],
            'document' => ['sometimes', 'string', 'max:255', Rule::unique('clients', 'document')],
        ]);

        $client->update([
            'name' => request('name', $client->name),
            'type' => request('type', $client->type),
            'document' => request('document', $client->document),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Client Updated',
            'data' => $client
        ], 201);
    }

    public function delete() {
        request()->validate([
            'id' => 'required',
        ]);

        $client = Client::find(request('id'));

        abort_if(!$client, 404, 'Client not found');

        $client->contacts()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Client deleted',
            'data' => $client
        ], 201);
    }

    public function get(Client $client) {
        return response()->json([
            'success' => true,
            'message' => 'Client',
            'data' => $client
        ], 201);
    }
}

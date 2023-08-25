<?php

namespace App\Http\Controllers;

use App\Models\AddressClient;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AddressClientController extends Controller
{
    public function index(Client $client)
    {
        return response()->json([
            'success' => true,
            'message' => 'Address',
            'address' => $client->address,
            'client' => $client
        ], 200);
    }

    public function create()
    {
        request()->validate([
            'client_id' => ['required', 'integer', Rule::exists('clients', 'id')],
            'cep' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'state' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255', Rule::in(['residence', 'work', 'charge'])],
        ]);

        $address = AddressClient::create([
            'client_id' => request('client_id'),
            'cep' => request('cep'),
            'city' => request('city'),
            'district' => request('district'),
            'address' => request('address'),
            'state' => request('state'),
            'type' => request('type'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Address Created',
            'data' => $address
        ], 201);
    }

    public function update(AddressClient $address)
    {
        request()->validate([
            'cep' => ['sometimes', 'string', 'max:255'],
            'city' => ['sometimes', 'string', 'max:255'],
            'district' => ['sometimes', 'string', 'max:255'],
            'address' => ['sometimes', 'string', 'max:255'],
            'state' => ['sometimes', 'string', 'max:255'],
            'type' => ['sometimes', 'string', 'max:255', Rule::in(['residence', 'work', 'charge'])],
        ]);

        $address->update([
            'cep' => request('cep'),
            'city' => request('city'),
            'district' => request('district'),
            'address' => request('address'),
            'state' => request('state'),
            'type' => request('type'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Address Updated',
            'data' => $address
        ], 201);
    }

    public function delete() {
        request()->validate([
            'id' => ['required', 'string', Rule::exists('address_clients', 'id')],
        ]);

        $address = AddressClient::find(request('id'));

        $address->delete();

        return response()->json([
            'success' => true,
            'message' => 'Address deleted',
            'data' => $address
        ], 201);
    }

    public function get(AddressClient $address) {
        return response()->json([
            'success' => true,
            'message' => 'Address',
            'data' => $address
        ], 201);
    }
}

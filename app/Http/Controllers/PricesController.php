<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Price;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PricesController extends Controller
{
    public function index(Client $client)
    {
        $collect = New Collection();

        $client->prices->each(function ($price) use ($collect) {
            $collect->push([
                'id' => $price->id,
                'price' => $price->price,
                'code_product' => $price->code_product,
                'product' => Product::find($price->product_id)->description,
                'client' => Client::find($price->client_id)->name,
            ]);
        });

        return response()->json([
            'success' => true,
            'message' => 'Prices',
            'prices' => $collect,
            'client' => $client
        ], 200);
    }

    public function create()
    {
        request()->validate([
            'product_id' => ['required', 'integer', Rule::exists('products', 'id')],
            'client_id' => ['required', 'integer', Rule::exists('clients', 'id')],
            'price' => ['required', 'numeric'],
        ]);

        $price = Price::create([
            'product_id' => request('product_id'),
            'client_id' => request('client_id'),
            'price' => request('price'),
            'code_product' => Product::find(request('product_id'))->code,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Price Created',
            'data' => $price
        ], 201);
    }

    public function update(Price $price)
    {
        request()->validate([
            'price' => ['sometimes', 'numeric'],
            'client_id' => ['sometimes', 'integer', Rule::exists('clients', 'id')],
            'product_id' => ['sometimes', 'integer', Rule::exists('products', 'id')],
        ]);

        $price->update([
            'price' => request('price', $price->price),
            'client_id' => request('client_id', $price->client_id),
            'product_id' => request('product_id', $price->product_id),
            'code_product' => request('product_id') ? Product::find(request('product_id', $price->product_id))->code : $price->code_product,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Price Updated',
            'data' => $price
        ], 200);
    }

    public function delete()
    {
        request()->validate([
            'id' => ['required', 'string', Rule::exists('prices', 'id')],
        ]);

        $price = Price::find(request('id'));

        $price->delete();

        return response()->json([
            'success' => true,
            'message' => 'Price Deleted',
            'data' => $price
        ], 200);
    }
    
    public function get(Price $price)
    {
        return response()->json([
            'success' => true,
            'message' => 'Price',
            'data' => $price
        ], 200);
    }
}

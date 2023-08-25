<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PricesController extends Controller
{
    public function index()
    {
        $price = Price::all();

        return response()->json([
            'success' => true,
            'message' => 'Prices',
            'contacts' => $price
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

    public function delete(Price $price)
    {
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

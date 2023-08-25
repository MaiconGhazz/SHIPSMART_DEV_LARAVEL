<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::all();

        return response()->json([
            'success' => true,
            'message' => 'Products',
            'contacts' => $product
        ], 200);
    }

    public function create()
    {
        request()->validate([
            'description' => ['required', 'string', 'max:255'],
            'client_id' => ['required', 'integer', Rule::exists('clients', 'id')],
            'price' => ['required', 'numeric'],
            'profit_margin' => ['required', 'integer'],
        ]);

        $product = Product::create([
            'description' => request('description'),
            'client_id' => request('client_id'),
            'price' => request('price'),
            'profit_margin' => request('profit_margin'),
            'code_client' => Client::find(request('client_id'))->code,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Product Created',
            'data' => $product
        ], 201);
    }

    public function update(Product $product)
    {
        request()->validate([
            'description' => ['sometimes', 'string', 'max:255'],
            'price' => ['sometimes', 'numeric'],
            'profit_margin' => ['sometimes', 'integer'],
        ]);

        $product->update([
            'description' => request('description', $product->description),
            'price' => request('price', $product->price),
            'profit_margin' => request('profit_margin', $product->profit_margin),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Product Updated',
            'data' => $product
        ], 201);
    }

    public function delete() {
        request()->validate([
            'id' => 'required',
        ]);

        $product = Product::find(request('id'));

        abort_if(!$product, 404, 'Product not found');

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted',
            'data' => $product
        ], 201);
    }

    public function get(Product $product) {
        return response()->json([
            'success' => true,
            'message' => 'Product',
            'data' => $product
        ], 201);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Price;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prices = [
            [
                'product_id' => $product = Product::all()->random(1)->first()->id,
                'client_id' => Product::find($product)->client_id,
                'code_product' => Product::find($product)->code,
                'price' => 2.5,
            ],
            [
                'product_id' => $product = Product::all()->random(1)->first()->id,
                'client_id' => Product::find($product)->client_id,
                'code_product' => Product::find($product)->code,
                'price' => 3,
            ],
            [
                'product_id' => $product = Product::all()->random(1)->first()->id,
                'client_id' => Product::find($product)->client_id,
                'code_product' => Product::find($product)->code,
                'price' => 3,
            ],
            [
                'product_id' => $product = Product::all()->random(1)->first()->id,
                'client_id' => Product::find($product)->client_id,
                'code_product' => Product::find($product)->code,
                'price' => 1,
            ],
            [
                'product_id' => $product = Product::all()->random(1)->first()->id,
                'client_id' => Product::find($product)->client_id,
                'code_product' => Product::find($product)->code,
                'price' => 15,
            ]
        ];

        collect($prices)->each(fn ($price) => Price::firstOrCreate($price));
    }
}

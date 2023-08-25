<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'description' => 'Cheques Sem Fundo',
                'client_id' => $client = Client::all()->random(1)->first()->id,
                'price' => 1,
                'profit_margin' => 100,
                'code_client' => Client::find($client)->code,
            ],
            [
                'description' => 'Anotações Negativas',
                'client_id' => $client = Client::all()->random(1)->first()->id,
                'price' => 2,
                'profit_margin' => 50,
                'code_client' => Client::find($client)->code,
            ],
            [
                'description' => 'Veicular Estadual',
                'client_id' => $client = Client::all()->random(1)->first()->id,
                'price' => 1.5,
                'profit_margin' => 75,
                'code_client' => Client::find($client)->code,
            ],
            [
                'description' => 'Rodas e Pneus',
                'client_id' => $client = Client::all()->random(1)->first()->id,
                'price' => 0.5,
                'profit_margin' => 150,
                'code_client' => Client::find($client)->code,
            ],
            [
                'description' => 'Completa',
                'client_id' => $client = Client::all()->random(1)->first()->id,
                'price' => 10,
                'profit_margin' => 20,
                'code_client' => Client::find($client)->code,
            ]
        ];

        collect($products)->each(fn ($product) => Product::firstOrCreate($product));
    }
}

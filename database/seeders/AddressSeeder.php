<?php

namespace Database\Seeders;

use App\Models\AddressClient;
use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $addresses = [
            [
                'client_id' => Client::all()->random(1)->first()->id,
                'cep' => '30710540',
                'city' => '123',
                'district' => 'Casa 1',
                'address' => 'Bairro 1',
                'state' => 'Cidade 1',
                'type' => 'residence'
            ],
            [
                'client_id' => Client::all()->random(1)->first()->id,
                'cep' => '31230060',
                'city' => '123',
                'district' => 'Casa 1',
                'address' => 'Bairro 1',
                'state' => 'Cidade 1',
                'type' => 'work'
            ],
            [
                'client_id' => Client::all()->random(1)->first()->id,
                'cep' => '30710530',
                'city' => '123',
                'district' => 'Casa 1',
                'address' => 'Bairro 1',
                'state' => 'Cidade 1',
                'type' => 'charge'
            ]
        ];

        collect($addresses)->each(fn ($address) => AddressClient::firstOrCreate($address));
    }
}

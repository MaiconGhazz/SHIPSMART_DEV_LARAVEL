<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            [
                'name' => 'Empresa 1',
                'type' => 'cnpj',
                'document' => '53923866000130',
            ],
            [
                'name' => 'Empresa 2',
                'type' => 'cpf',
                'document' => '99544190554',
            ]
        ];

        collect($clients)->each(fn ($client) => Client::firstOrCreate($client));
    }
}

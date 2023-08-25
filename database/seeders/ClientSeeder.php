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
        $contacts = [
            [
                'name' => 'Administrator',
                'type' => 'PF',
                'document' => '00000000000',
            ],
        ];

        collect($contacts)->each(fn ($contact) => Client::firstOrCreate($contact));
    }
}

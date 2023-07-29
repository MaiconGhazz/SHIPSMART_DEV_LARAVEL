<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contacts = [
            [
                'name' => 'Administrator',
                'email' => 'admin@admin.com',
                'tel' => '123456789',
                'cep' => '123456789',
                'city' => '123456789',
                'district' => '123456789',
                'end' => '123456789',
                'state' => '123456789',
            ],
        ];

        collect($contacts)->each(fn ($contact) => Contact::firstOrCreate($contact));
    }
}

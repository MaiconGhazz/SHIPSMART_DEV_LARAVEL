<?php

namespace Tests\Feature;

use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_create(): void
    {
        Contact::create([
            'name' => 'Test',
            'email' => 'teste@teste.com',
            'tel' => '99999999999',
            'cep' => 'Teste',
            'city' => 'Teste',
            'district' => 'Teste',
            'end' => 'Teste',
            'state' => 'Teste',
        ]);
            

        $this->assertTrue(true);
    }

    public function test_update(): void
    {
        $contact = Contact::first();

        $contact->update([
            'name' => 'Test',
            'email' => 'teste@teste.com',
            'tel' => '99999999999',
            'cep' => 'Teste',
            'city' => 'Teste',
            'district' => 'Teste',
            'end' => 'Teste',
            'state' => 'Teste',
        ]);

        $this->assertTrue(true);
    }

    public function test_delete(): void
    {
        $contact = Contact::first();

        if($contact){
            $contact->delete();
        }

        $this->assertTrue(true);
    }
}

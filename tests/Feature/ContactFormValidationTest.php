<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactFormValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_creation_requires_valid_data()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/contacts', [
            'name' => '',
            'contact' => '',
            'email' => 'invalid-email',
        ]);

        $response->assertSessionHasErrors(['name', 'contact', 'email']);
    }

    public function test_contact_update_requires_valid_data()
    {
        $user = User::factory()->create();
        $contact = Contact::factory()->create();

        $response = $this->actingAs($user)->put("/contacts/{$contact->id}", [
            'name' => '',
            'contact' => '',
            'email' => 'invalid-email',
        ]);

        $response->assertSessionHasErrors(['name', 'contact', 'email']);
    }

    public function test_contact_creation_with_valid_data()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/contacts', [
            'name' => 'Valid Name',
            'contact' => '123456789',
            'email' => 'valid@example.com',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('contacts', [
            'name' => 'Valid Name',
            'contact' => '123456789',
            'email' => 'valid@example.com',
        ]);
    }

    public function test_contact_update_with_valid_data()
    {
        $user = User::factory()->create();
        $contact = Contact::factory()->create();

        $response = $this->actingAs($user)->put("/contacts/{$contact->id}", [
            'name' => 'Updated Name',
            'contact' => '987654321',
            'email' => 'updated@example.com',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('contacts', [
            'id' => $contact->id,
            'name' => 'Updated Name',
            'contact' => '987654321',
            'email' => 'updated@example.com',
        ]);
    }

    public function test_email_must_be_unique()
    {
        $user = User::factory()->create();
        Contact::factory()->create(['email' => 'duplicate@example.com']);

        $response = $this->actingAs($user)->post('/contacts', [
            'name' => 'Another Name',
            'contact' => '123123123',
            'email' => 'duplicate@example.com',
        ]);

        $response->assertSessionHasErrors(['email']);
    }
}

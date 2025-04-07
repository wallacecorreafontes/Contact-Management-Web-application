<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        Contact::updateOrCreate(
            ['email' => 'alice@example.com'],
            ['name' => 'Alice Santos', 'contact' => '912345678']
        );

        Contact::updateOrCreate(
            ['email' => 'bruno@example.com'],
            ['name' => 'Bruno Lima', 'contact' => '987654321']
        );

        Contact::updateOrCreate(
            ['email' => 'carla@example.com'],
            ['name' => 'Carla Souza', 'contact' => '934561278']
        );
    }
}

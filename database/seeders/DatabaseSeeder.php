<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(LabelSeeder::class);
        $this->call(ContentSeeder::class);

        User::updateOrCreate(
            ['email' => 'studio@bcrl.local'],
            [
                'name' => 'BCRL Studio',
                'password' => 'BigCheese2026',
                'email_verified_at' => now(),
                'is_admin' => true,
            ],
        );
    }
}

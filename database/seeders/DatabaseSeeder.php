<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\DealStage;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        DealStage::factory()->create([
            'name'=> 'Generated',
        ]);

        DealStage::factory()->create([
            'name'=> 'Lost',
        ]);

        DealStage::factory()->create([
            'name'=> 'Win',
        ]);

        $this->call(CountrySeeder::class);
    }
}

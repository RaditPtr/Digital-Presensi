<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(TblUserSeeder::class);
        $this->call(SiswaSeeder::class);
        $this->call(JurusanSeeder::class);
        $this->call(AngkatanSeeder::class);
        $this->call(GuruSeeder::class);
        $this->call(WaliKelasSeeder::class);
        $this->call(KelasSeeder::class);
    }
}

<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Arr;

class AngkatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $datas = [1, 2, 3, 4, 5];

        foreach ($datas as $data) {
            for ($i = 1; $i <= 1; $i++) {
                DB::table('angkatan')->insert([
                    'tahun_masuk' => $faker->date(),
                    'tahun_keluar' => $faker->date(),
                ]);
            }
        }
    }
}

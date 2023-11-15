<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Arr;

class WaliKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $datas = [1, 2, 3, 4];

        foreach ($datas as $data) {
            for ($i = 1; $i <= 1; $i++) {
                DB::table('wali_kelas')->insert([
                    'id_walas' => $data,
                    'id_guru' => $data,
                ]);
            }
        }
    }
}

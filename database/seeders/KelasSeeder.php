<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Arr;

class KelasSeeder extends Seeder
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
                DB::table('kelas')->insert([
                    'id_angkatan' => $data,
                    'id_jurusan' => $data,
                    'id_walas' => $data,
                    'nama_kelas' => 'Kelas '. Arr::random(['A', 'B', 'C'])
                ]);
            }
        }
    }
}

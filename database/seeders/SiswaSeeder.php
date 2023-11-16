<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
    
        $datas = [4];
        $datakelas = [1, 2, 3 ,4];
    
        foreach ($datas as $data) {
            for ($i = 1; $i <= 9; $i++) {
                DB::table('siswa')->insert([
                    'nis' => $faker->numerify('2########'),
                    'id_user' => $data,
                    'id_kelas' => $data,
                    'nama_siswa' => $faker->name(),
                    'jenis_kelamin' => Arr::random(['laki-laki', 'perempuan']),
                    'foto_siswa' => $faker->image(),
                ]);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PengurusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengurus_kelas')->insert(
            [
                'nis' => '271824730',
                'jabatan' => Arr::random(['Ketua kelas', 'Wakil ketua', 'Sekretaris', 'Bendahara'])
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PresensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        DB::table('presensi_siswa')->insert(
            [
                'nis' => '271824730',
                'tanggal_presensi' => $faker->date(),
                'status_hadir' => 'Hadir',
                'waktu_presensi' => $faker->time(),
                'foto_bukti' =>  $faker->image(),
            ]
        );

    //     DB::table('presensi_siswa')->insert(
    //         [
    //             'nis' => '2',
    //             'tanggal_presensi' => $faker->date(),
    //             'status_hadir' => 'Hadir',
    //             'waktu_presensi' => $faker->time(),
    //             'foto_bukti' =>  $faker->image(),
    //         ]
    //     );

    //     DB::table('presensi_siswa')->insert(
    //         [
    //             'nis' => '3',
    //             'tanggal_presensi' => $faker->date(),
    //             'status_hadir' => 'Izin',
    //             'waktu_presensi' => $faker->time(),
    //             'foto_bukti' =>  $faker->image(),
    //         ]
    //     );

    //     DB::table('presensi_siswa')->insert(
    //         [
    //             'nis' => '4',
    //             'tanggal_presensi' => $faker->date(),
    //             'status_hadir' => 'Alpha',
    //             'waktu_presensi' => $faker->time(),
    //             'foto_bukti' =>  $faker->image(),
    //         ]
    //     );

    //     DB::table('presensi_siswa')->insert(
    //         [
    //             'nis' => '5',
    //             'tanggal_presensi' => $faker->date(),
    //             'status_hadir' => 'Alpha',
    //             'waktu_presensi' => $faker->time(),
    //             'foto_bukti' =>  $faker->image(),
    //         ]
    //     );

    //     DB::table('presensi_siswa')->insert(
    //         [
    //             'nis' => '6',
    //             'tanggal_presensi' => $faker->date(),
    //             'status_hadir' => 'Izin',
    //             'waktu_presensi' => $faker->time(),
    //             'foto_bukti' =>  $faker->image(),
    //         ]
    //     );
    }
}

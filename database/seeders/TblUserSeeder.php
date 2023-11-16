<?php

namespace Database\Seeders;

use App\Models\tbl_user;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TblUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = [
            [
                'username' => 'tatausaha',
                'role' => 'tatausaha',
                'password' => Hash::make('123')
            ],
            [
                'username' => 'walikelas',
                'role' => 'walikelas',
                'password' => Hash::make('123')
            ], 
            [
                'username' => 'gurubk',
                'role' => 'gurubk',
                'password' => Hash::make('123')
            ], 
            [
                'username' => 'siswa1',
                'role' => 'siswa',
                'password' => Hash::make('123')
            ],
            [
                'username' => 'siswa2',
                'role' => 'siswa',
                'password' => Hash::make('123')
            ],
            [
                'username' => 'siswa3',
                'role' => 'siswa',
                'password' => Hash::make('123')
            ],
            [
                'username' => 'siswa4',
                'role' => 'siswa',
                'password' => Hash::make('123')
            ],
            [
                'username' => 'siswa5',
                'role' => 'siswa',
                'password' => Hash::make('123')
            ],
            [
                'username' => 'siswa6',
                'role' => 'siswa',
                'password' => Hash::make('123')
            ],
            [
                'username' => 'siswa7',
                'role' => 'siswa',
                'password' => Hash::make('123')
            ], 
            [
                'username' => 'gurupiket',
                'role' => 'gurupiket',
                'password' => Hash::make('123')
            ],
        ];

        // Melakukan looping data dengan foreach
        foreach ($userData as $user => $val) {
            tbl_user::create($val);
        }
    }
}

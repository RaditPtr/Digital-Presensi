<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kelas;

class KelasController extends Controller
{
    public function indexKelas(Kelas $kelas)
    {

        $tampilkan_kelas = DB::select(' SELECT * from view_Kelas');
        // $totalkelas = DB::select('SELECT Countkelas() AS Totalkelas');

        // array untuk menangkap data kelas dari view dan 
        // menangkap data jumlah kelas dari stored function
        $data = [
            'kelas' => $tampilkan_kelas,
            // 'siswa' => $siswa->all(),
        ];

        $data = [
            'kelas' => $kelas->all(),
        ];
        return view('kelas.index', $data);
    }

}

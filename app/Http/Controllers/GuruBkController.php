<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\PresensiSiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class GuruBkController extends Controller
{
    public function indexSiswa(Siswa $siswa)
    {
        $tampilkan_siswa = DB::select(' SELECT * from view_siswa');
        $totalsiswa = DB::select('SELECT CountSiswa() AS TotalSiswa');

        // array untuk menangkap data siswa dari view dan 
        // menangkap data jumlah siswa dari stored function
        $data = [
            'siswa' => $tampilkan_siswa,
            // 'siswa' => $siswa->all(),
            'jumlah_siswa' => $totalsiswa[0]->TotalSiswa
        ];

        return view('siswa.index', $data);
    }

    public function indexPresensiSiswa(PresensiSiswa $presensisiswa)
    {

        $data = [
            'presensisiswa' => $presensisiswa->all(),
        ];
        return view('presensisiswa.index', $data);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\PresensiSiswa;
use App\Models\tbl_user;
use App\Models\Kelas;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;


class SiswaController extends Controller
{
    //
    public function createPresensi(Siswa $siswa)
    {

        $auth = Auth::user()->id_user;

        $siswa = $siswa
        ->join('tbl_user', 'siswa.id_user', '=', 'tbl_user.id_user')
        ->where('siswa.id_user', $auth)->get();
        $data = [
            'siswa' => $siswa
        ];
        return view('presensisiswa.tambah', $data);
    }

    public function storePresensi(Request $request, PresensiSiswa $presensi, tbl_user $tbl_user)
    {
        $data = $request->validate([
            'nis' => 'required',
            'status_hadir' => 'required',
            'foto_bukti' => 'required',
        ]);
        if ($request->hasFile('foto_bukti') && $request->file('foto_bukti')->isValid()) {
            $foto_file = $request->file('foto_bukti');
            $foto_nama = md5($foto_file->getClientOriginalName() . time()) . '.' . $foto_file->getClientOriginalExtension();
            $foto_file->move(public_path('foto'), $foto_nama);
            $data['foto_bukti'] = $foto_nama;
        } else {
            return back()->with('error', 'File upload failed. Please select a valid file.');
        }

        $user = Auth::user();
        $data['pembuat'] = $user->role;

        $store = DB::statement("CALL CreatePresensi(?,?,?)", [$data['nis'], $data['status_hadir'], $data['foto_bukti']]);
        if ($store) {
            return redirect('dashboard/siswa');
        } else {
            return back()->with('error', 'Data presensi gagal ditambahkan');
        }
    }
    public function profilSiswa(Tbl_user $tbl_user)
    {
        $auth = Auth::user();

        $data = [
            'akun' => $tbl_user
                ->join('siswa', 'tbl_user.id_user', '=', 'siswa.id_user')
                ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
                ->where('siswa.id_user', $auth->id_user)->get()
        ];

        // dd($data);
        return view('profil.profilsiswa', $data);
    }
}

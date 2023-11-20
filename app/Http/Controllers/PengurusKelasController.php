<?php

namespace App\Http\Controllers;

use App\Models\PengurusKelas;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\PresensiSiswa;
use App\Models\tbl_user;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class PengurusKelasController extends Controller
{
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
            return redirect('dashboard/pengurus');
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

    public function indexSiswa(tbl_user $tbl_user, Siswa $siswa, PengurusKelas $pengurus)
    {
        $totalsiswa = DB::select('SELECT CountSiswa() AS TotalSiswa');

        $ambildataakun = $siswa
        ->join('kelas', 'kelas.id_kelas', '=', 'siswa.id_kelas')
            ->where('siswa.id_user', Auth::user()->id_user)->get();

        $tampilkan_siswa = $siswa
        ->join('kelas', 'kelas.id_kelas', '=', 'siswa.id_kelas')
        ->where('kelas.id_kelas', $ambildataakun[0]->id_kelas)
        ->get();

        // array untuk menangkap data siswa dari view dan 
        // menangkap data jumlah siswa dari stored function
        $data = [

            'siswa' => $tampilkan_siswa,
            'jumlah_siswa' => $totalsiswa[0]->TotalSiswa,
        ];

        // dd($data);   //


        return view('siswa.index', $data);
    }

    public function detailSiswa(Request $request, Siswa $siswa)
    {
        $data = [
            'detail' => $siswa->where('nis', $request->id)
                ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')->get()
        ];
        // dd($data);
        return view('siswa.detail', $data);
    }


    public function indexPresensiSiswa(PresensiSiswa $presensi, Siswa $siswa)
    {
        $ambildataakun = $siswa
        ->join('kelas', 'kelas.id_kelas', '=', 'siswa.id_kelas')
        ->where('siswa.id_user', Auth::user()->id_user)->get();
        $tampilkan_presensi = $presensi
            ->join('siswa', 'siswa.nis', '=', 'presensi_siswa.nis')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
            ->where('kelas.id_kelas', $ambildataakun[0]->id_kelas)->get();

        $data = [
            'presensi' => $tampilkan_presensi
        ];

        // dd($data);

        return view('presensisiswa.index', $data);
    }

    public function detailPresensi(Request $request, PresensiSiswa $presensi)
    {
        $data = [
            'detail' => $presensi->where('id_presensi', $request->id)
                ->join('siswa', 'presensi_siswa.nis', '=', 'siswa.nis')
                ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')->get()
        ];
        // dd($data);
        return view('presensisiswa.detail', $data);
    }
}

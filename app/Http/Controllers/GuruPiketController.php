<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\PresensiSiswa;
use App\Models\tbl_user;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class GuruPiketController extends Controller
{
    public function indexSiswa(Siswa $siswa)
    {
        $data = [
            'siswa' => $siswa->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')->get()
        ];
        return view('siswa.index', $data);
    }

    public function indexKelas(Kelas $kelas)
    {
        $data = [
            'kelas' => $kelas->all()
        ];
        return view('kelas.index', $data);
    }

    public function indexPresensi()
    {
        $data = [
            'presensi' => DB::table('view_presensi')->get()
        ];
        return view('presensisiswa.index', $data);
    }

    public function createPresensi(Siswa $siswa)
    {
        $data = [
            'siswa' => $siswa->all()
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
            return redirect('dashboard/gurupiket/presensi');
        } else {
            return back()->with('error', 'Data presensi gagal ditambahkan');
        }
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

    public function editPresensi(Request $request, PresensiSiswa $presensi)
    {
        $data = [
            'presensi' => $presensi->where('id_presensi', $request->id)
                ->join('siswa', 'presensi_siswa.nis', '=', 'siswa.nis')->get()
        ];
        // dd($data);
        return view('presensisiswa.edit', $data);
    }

    public function updatePresensi(Request $request, PresensiSiswa $presensi)
    {
        $id_presensi = $request->id_presensi;
        $data = $request->validate([
            'status_hadir' => 'sometimes',
            'foto_bukti' => 'sometimes'
        ]);
        if ($id_presensi !== null) {
            if ($request->hasFile('foto_bukti') && $request->file('foto_bukti')->isValid()) {
                $foto_file = $request->file('foto_bukti');
                $foto_extension = $foto_file->getClientOriginalExtension();
                $foto_nama = md5($foto_file->getClientOriginalName() . time()) . '.' . $foto_extension;
                $foto_file->move(public_path('foto'), $foto_nama);

                $update_data = $presensi->where('id_presensi', $id_presensi)->first();
                File::delete(public_path('foto') . '/' . $update_data->file);

                $data['foto_bukti'] = $foto_nama;
            }

            $user = Auth::user();
            // $data['pembuat'] = $user->role;

            $dataUpdate = $presensi->where('id_presensi', $id_presensi)->update($data);

            if ($dataUpdate) {
                return redirect('dashboard/gurupiket/presensi')->with('success', 'Data berhasil diupdate');
            } else {
                return back()->with('error', 'Data gagal diupdate');
            }
        }
    }


    public function destroyPresensi(Request $request, PresensiSiswa $presensi)
    {
        $id_presensi = $request->input('id_presensi');
        $hapusPresensi = $presensi->where('id_presensi', $id_presensi)->delete();
        if ($hapusPresensi) {
            $pesan = [
                'success' => true,
                'pesan' => 'Data berhasil di hapus'
            ];
        } else {
            $pesan = [
                'success' => false,
                'pesan' => 'Data gagal di hapus'
            ];
        }

        return response()->json($pesan);
    }
}

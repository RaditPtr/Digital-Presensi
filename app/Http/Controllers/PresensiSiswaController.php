<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\PresensiSiswa;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class PresensiSiswaController extends Controller
{
    public function index(Siswa $siswa, PresensiSiswa $presensisiswa)
    {

        $data = [
            'presensisiswa' => $presensisiswa->all(),
        ];
        return view('siswa.index', $data);
    }

    public function create(Kelas $kelas)
    {
        $kelas = $kelas
            ->join('jurusan', 'kelas.id_jurusan', '=', 'jurusan.id_jurusan')
            ->get();

        // dd($kelas);
        return view("siswa.tambah", ["kelas" => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Siswa $siswa)
    {
        $data = $request->validate(
            [
                'nis' => 'required',
                'nama_siswa' => 'required',
                'jenis_kelamin' => 'required',
                'id_kelas' => 'required',
                'foto_siswa' => 'required|file',
            ]
        );

        $data['id_user'] = Auth::user()->id_user;

        if ($request->hasFile('foto_siswa')) {
            $foto_file = $request->file('foto_siswa');
            $foto_nama = $foto_file->getClientOriginalName() . time() . '.' . $foto_file->getClientOriginalExtension();
            $foto_file->move(public_path('foto'), $foto_nama);
            $data['foto_siswa'] = $foto_nama;
        }

        if ($siswa->create($data)) {
            return redirect()->to('dashboard/siswa')->with("success", "Data Surat Berhasil Ditambahkan");
        } else {
            return back()->with("error", "Data Surat Gagal Ditambahkan");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Siswa $siswa, Kelas $kelas)
    {
        $data = [
            "siswa" => $siswa->where('nis', $request->id)->first(),
            "kelas" => $kelas
                ->join('jurusan', 'kelas.id_jurusan', '=', 'jurusan.id_jurusan')
                ->get()
        ];
        // dd($data);
        return view('siswa.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $nis = $request->input('nis');

        $data = $request->validate(
            [
                'nama_siswa' => 'sometimes',
                'jenis_kelamin' => 'sometimes',
                'foto_siswa' => 'sometimes|file'
            ]
        );

        if ($nis !== null) {
            if ($request->hasFile('foto_siswa') && $request->file('foto_siswa')->isValid()) {
                $foto_file = $request->file('foto_siswa');
                $foto_extension = $foto_file->getClientOriginalExtension();
                $foto_nama = md5($foto_file->getClientOriginalName() . time()) . '.' . $foto_extension;
                $foto_file->move(public_path('foto'), $foto_nama);

                $update_data = $siswa->where('nis', $nis)->first();
                File::delete(public_path('foto') . '/' . $update_data->file);

                $data['foto_siswa'] = $foto_nama;
            }

            $dataUpdate = $siswa->where('nis', $nis)->update($data);

            if ($dataUpdate) {
                return redirect('dashboard/siswa');
            }
        }

        return back()->with('error', 'Data gagal diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Siswa $siswa)
    {
        $nis = $request->input('nis');
        $aksi = Siswa::where('nis', $nis)->delete();

        if ($aksi) {
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

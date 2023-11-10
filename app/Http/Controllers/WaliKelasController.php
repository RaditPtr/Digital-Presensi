<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\PresensiSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class WaliKelasController extends Controller
{
    public function indexSiswa()
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

    public function createSiswa(Siswa $siswa ,Kelas $kelas)
    {


        $kelas = $kelas
            ->join('jurusan', 'kelas.id_jurusan', '=', 'jurusan.id_jurusan')
            ->get();
        $siswa = $siswa->all();

        // dd($kelas);
        return view("siswa.tambah", ["kelas" => $kelas, "siswa" => $siswa]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeSiswa(Request $request, Siswa $siswa)
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

        if (DB::statement('CALL CreateAkunSiswa(?,?,?,?,?,?)', [
            $data['nis'], $data['id_user'],
            $data['id_kelas'], $data['nama_siswa'], $data['jenis_kelamin'], $data['foto_siswa']
        ])) {
            return redirect()->to('dashboard/siswa')->with("success", "Data siswa Berhasil Ditambahkan");
        } else {
            return back()->with("error", "Data siswa Gagal Ditambahkan");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editSiswa(Request $request, Siswa $siswa, Kelas $kelas)
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
    public function updateSiswa(Request $request, Siswa $siswa)
    {
        $nis = $request->input('nis');

        $data = $request->validate(
            [
                'nama_siswa' => 'sometimes',
                'jenis_kelamin' => 'sometimes',
                'id_kelas' => 'sometimes',
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
                return redirect('dashboard/siswa')->with('success', 'Data Berhasil Diupdate');
            } else {
                return back()->with('error', 'Data Gagal Diupdate');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroySiswa(Request $request, Siswa $siswa)
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


    //============================================================================
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

        // $data = [
        //     'kelas' => $kelas->all(),
        // ];

        // dd($data);
        return view('kelas.index', $data);
    }
    //================================================================


    public function indexPresensiSiswa()
    {
        $tampilkan_presensi = DB::select(' SELECT * from view_presensi');

        $data = [
            'presensi' => $tampilkan_presensi
        ];

        return view('presensisiswa.index', $data);
    }
}

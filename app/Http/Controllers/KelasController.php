<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Angkatan;
use App\Models\Walikelas;


class KelasController extends Controller
{
    public function indexKelas(Kelas $kelas)
    {
        $tampilkan_kelas = DB::select(' SELECT * from view_Kelas');

        // array untuk menangkap data kelas dari view dan 
        // menangkap data jumlah kelas dari stored function
        $data = [
            'kelas' => $tampilkan_kelas,
            // 'siswa' => $siswa->all(),
        ];


        return view('kelas.index', $data);
    }

    public function createKelas(Kelas $kelas)
    {
        $datakelas = [
            'jurusan' => DB::table('jurusan')->get(),
            'angkatan' => DB::table('angkatan')->get(),
            'walikelas' => DB::table('wali_kelas')
                ->join('guru', 'wali_kelas.id_guru', '=', 'guru.id_guru')
                ->select('wali_kelas.id_walas', 'guru.nama_guru as nama_walikelas')
                ->get(),
        ];

        return view("kelas.tambah", ["datakelas" => $datakelas]);
    }

    public function editKelas($id, Kelas $kelas)
    {
        $kelasData = $kelas
            ->join('jurusan', 'kelas.id_jurusan', '=', 'jurusan.id_jurusan')
            ->where('kelas.id_kelas', $id)
            ->first(); // Mengambil data kelas pertama yang cocok dengan ID

        $datakelas = [
            'jurusan' => DB::table('jurusan')->get(),
            'angkatan' => DB::table('angkatan')->get(),
            'walikelas' => DB::table('wali_kelas')
                ->join('guru', 'wali_kelas.id_guru', '=', 'guru.id_guru')
                ->select('wali_kelas.id_walas', 'guru.nama_guru as nama_walikelas')
                ->get(),
        ];

        return view("kelas.edit", ["kelas" => $kelasData, "datakelas" => $datakelas]);
    }

    public function simpanKelas(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'nama_kelas' => 'required',
            'id_jurusan' => 'required', // Sesuaikan dengan validasi yang sesuai
            'id_angkatan' => 'required', // Sesuaikan dengan validasi yang sesuai
            'id_walas' => 'required', // Sesuaikan dengan validasi yang sesuai
        ]);

        // Buat objek baru dari model Kelas
        $kelas = new Kelas();

        // Isi objek dengan data dari form
        $kelas->nama_kelas = $request->nama_kelas;
        $kelas->id_jurusan = $request->id_jurusan;
        $kelas->id_angkatan = $request->id_angkatan;
        $kelas->id_walas = $request->id_walas;

        // Simpan data ke dalam database
        $saved = $kelas->save();

        if ($saved) {
            return redirect('dashboard/kelas')->with('success', 'Data Kelas baru berhasil ditambah');
        } else {
            return back()->with('error', 'Gagal menambahkan data kelas');
        }
    }

    public function updateKelas(Request $request, Kelas $kelas)
    {
        $selectedId = $request->input('id_kelas');

        $data = $request->validate([
            'nama_kelas' => 'required',
            'id_jurusan' => 'required',
            'id_angkatan' => 'required',
            'id_walas' => 'required'
        ]);

        if ($selectedId !== null) {
            $kelasData = $kelas->where('id_kelas', $selectedId)->first();

            if ($kelasData) {
                $updateData = [
                    'nama_kelas' => $data['nama_kelas'],
                    'id_jurusan' => $data['id_jurusan'],
                    'id_angkatan' => $data['id_angkatan'],
                    'id_walas' => $data['id_walas']
                ];

                $kelasUpdate = $kelas->where('id_kelas', $selectedId)->update($updateData);

                if ($kelasUpdate) {
                    return redirect('dashboard/kelas')->with('success', 'Data Kelas berhasil diupdate');
                } else {
                    return back()->with('error', 'Data Kelas gagal diupdate');
                }
            }
        }
    }


    public function detailKelas(Request $request, Kelas $kelas)
    {
        $detailkelas = DB::table('view_kelas')->where('id_kelas', $request->id)->get();
        $data = [
            'detail' => $detailkelas
            // ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
        ];
        // dd($data);
        return view('Kelas.detail', $data);
    }



    public function destroyKelas(Kelas $kelas, Request $request)
    {
        $id_kelas = $request->input('id_kelas');

        // Hapus 
        $aksi = $kelas->where('id_kelas', $id_kelas)->delete();

        if ($aksi) {
            // Pesan Berhasil
            $pesan = [
                'success' => true,
                'pesan'   => 'Data user berhasil dihapus'
            ];
        } else {
            // Pesan Gagal
            $pesan = [
                'success' => false,
                'pesan'   => 'Data gagal dihapus'
            ];
        }

        return response()->json($pesan);
    }
}

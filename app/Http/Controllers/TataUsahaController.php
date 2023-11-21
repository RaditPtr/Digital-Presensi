<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\tbl_user;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class TataUsahaController extends Controller
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
            return redirect('dashboard/tatausaha/kelas')->with('success', 'Data Kelas baru berhasil ditambah');
        } else {
            return back()->with('error', 'Gagal menambahkan data kelas');
        }
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
                    return redirect('dashboard/tatausaha/kelas')->with('success', 'Data Kelas berhasil diupdate');
                } else {
                    return back()->with('error', 'Data Kelas gagal diupdate');
                }
            }
        }
    }

    public function unduhKelas(Kelas $kelas)
    {
        $kelas = $kelas
            ->join('jurusan', 'kelas.id_jurusan', '=', 'jurusan.id_jurusan')
            ->join('angkatan', 'kelas.id_angkatan', '=', 'angkatan.id_angkatan')
            ->join('wali_kelas', 'kelas.id_walas', '=', 'wali_kelas.id_walas')
            ->join('guru', 'wali_kelas.id_guru', '=', 'guru.id_guru')->get();
        $pdf = PDF::loadView('kelas.unduh', ['kelas' => $kelas]);
        return $pdf->download('data-kelas.pdf');
    }

    public function detailKelas(Request $request, Kelas $kelas)
    {
        $detailkelas = DB::table('view_kelas')->where('id_kelas', $request->id)->get();
        $jumlahsiswa = DB::table('kelas')->select(DB::raw('COUNT(*) as JumlahSiswa'))
            ->join('siswa', 'siswa.id_kelas', '=', 'kelas.id_kelas')
            ->where('siswa.id_kelas', $request->id)->get();
        $data = [
            'detail' => $detailkelas,
            'jumlahsiswa' => $jumlahsiswa[0]->JumlahSiswa
            // ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
        ];
        // dd($data);
        return view('Kelas.detail', $data);
    }

    public function createSiswa(Siswa $siswa, Kelas $kelas, tbl_user $tbl_user)
    {


        $kelas = $kelas
            ->join('jurusan', 'kelas.id_jurusan', '=', 'jurusan.id_jurusan')
            ->get();
        $auth = Auth::user()->id_user;
        $akun = $tbl_user
            ->join('guru', 'tbl_user.id_user', '=', 'guru.id_user')
            ->join('wali_kelas', 'guru.id_guru', '=', 'wali_kelas.id_guru')
            ->join('kelas', 'wali_kelas.id_walas', '=', 'kelas.id_walas')
            ->where('guru.id_user', $auth)->first();

        // $data = [
        //     'akun' 
        // ];

        // dd($kelas);
        return view("siswa.tambah", ["kelas" => $kelas, "siswa" => $siswa, "akun" => $akun]);
    }

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
            return redirect()->to('dashboard/tatausaha/siswa')->with("success", "Data siswa Berhasil Ditambahkan");
        } else {
            return back()->with("error", "Data siswa Gagal Ditambahkan");
        }
    }

    public function destroySiswa(Request $request, Siswa $siswa)
    {
        $nis = $request->input('nis');
        $hapusSiswa = $siswa->where('nis', $nis)->delete();
        // $aksi = Siswa::where('nis', $nis)->delete();

        if ($hapusSiswa) {
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

    public function updateSiswa(Request $request, Siswa $siswa)
    {
        $nis = $request->input('nis');

        $data = $request->validate(
            [
                'nama_siswa' => 'sometimes',
                'jenis_kelamin' => 'sometimes',
                // 'id_kelas' => 'sometimes',
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
                return redirect('dashboard/tatausaha/siswa')->with('success', 'Data Berhasil Diupdate');
            } else {
                return back()->with('error', 'Data Gagal Diupdate');
            }
        }
    }

    public function indexAkun(tbl_user $akun)
    {
        // mengambil data jumlah akun dan mendeklarasikan nya
        $totalAkun = DB::select('SELECT CountTotalDataAkun() AS totalAkun')[0]->totalAkun;

        // untuk menampilkan data akun dan data jumlah akun
        $data = [
            'akun' => $akun->all(),
            'jumlahAkun' => $totalAkun
        ];
        return view('akun.index', $data);
    }

    public function createAkun()
    {
        return view('akun.tambah');
    }

    public function storeAkun(Request $request, tbl_user $akun)
    {
        // Array untuk 
        $data = $request->validate(
            [
                'username' => ['required'],
                'password' => ['required'],
                'role'    => ['required'],
            ]
        );

        $data['password'] = hash::make($data['password']);
        //Proses Insert
        if (DB::statement("CALL CreateUser(?,?,?)", [$data['username'], $data['password'], $data['role']])) {
            // Simpan jika data terisi semua
            // dd($data);
            return redirect('dashboard/tatausaha/akun')->with('success', 'Data user baru berhasil ditambah');
        } else {
            // Kembali ke form tambah data
            return back()->with('error', 'Data user gagal ditambahkan');
        }
    }

    public function editAkun(string $id, tbl_user $akun)
    {
        $data = [
            'akun' =>  tbl_user::where('id_user', $id)->first()
        ];

        return view('akun.edit', $data);
    }

    public function updateAkun(Request $request, tbl_user $akun)
    {
        // Array untuk memvalidasi data yg masuk/request dari pengguna
        $data = $request->validate([
            'username' => ['sometimes'],
            'password' => ['sometimes'],
            'role'    => ['sometimes'],
        ]);

        $id_user = $request->input('id_user');
        if ($id_user !== null) {
            // Process Update

            if ($request->has('password')) {
                $data['password'] = Hash::make($request->input('password'));
            };

            DB::beginTransaction();
            try {
                $dataUpdate = $akun->where('id_user', $id_user)->update($data);
                DB::commit();
                return redirect('dashboard/akun')->with('success', 'Data user berhasil di update');
            } catch (Exception $e) {
                DB::rollBack();
                dd($e->getMessage());
            }
        }
    }

    public function destroyAkun(tbl_user $akun, Request $request)
    {
        $id_user = $request->input('id_user');

        // Hapus 
        $aksi = $akun->where('id_user', $id_user)->delete();

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

    public function indexGuru(Guru $guru)
    {
        $totalGuru = DB::select('SELECT CountTotalDataGuru() AS totalGuru')[0]->totalGuru;

        $guru = DB::table('view_guru')->get();
        $data = [
            'user' => $guru,
            'jumlahGuru' => $totalGuru
        ];
        // dd($data);
        return view('guru.index', $data);
    }

    public function createGuru(tbl_user $user)
    {
        $userAkun = $user->all();


        return view('guru.tambah', [
            'id_user' => $userAkun,
            'username' => $userAkun,
        ]);
    }

    public function storeGuru(Request $request, Guru $guru)
    {
        $data = $request->validate([
            'id_user' => 'required',
            'nama_guru' => 'required',
            'foto_guru' => 'sometimes'
        ]);

        if ($request->hasFile('foto_guru') && $request->file('foto_guru')) {
            $foto_file = $request->file('foto_guru');
            $foto_nama = md5($foto_file->getClientOriginalName() . time()) . '.' . $foto_file->getClientOriginalExtension();
            $foto_file->move(public_path('foto'), $foto_nama);
            $data['foto_guru'] = $foto_nama;
        }

        // Proses Insert
        if ($guru->create($data)) {
            return redirect('dashboard/tatausaha/guru')->with('success', 'Data Guru baru berhasil ditambah');
        }

        return back()->with('error', 'Data jenis surat gagal ditambahkan');
    }

    public function destroyGuru(Guru $guru, Request $request)
    {
        $idGuru = $request->input('id_guru');
        $guru = Guru::find($idGuru);

        if (!$guru) {
            // Jika data guru tidak ditemukan, kembalikan respons kesalahan
            return response()->json(['success' => false, 'message' => 'Data Guru tidak ditemukan']);
        }

        // Hapus foto guru jika ada
        if ($guru->foto_guru) {
            File::delete(public_path('foto') . '/' . $guru->foto_guru);
        }

        // Hapus data guru
        $guru->delete();

        return response()->json(['success' => true, 'pesan' => 'Data berhasil dihapus']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\tbl_user;
use App\Models\guru;
use App\Models\PengurusKelas;
use App\Models\PresensiSiswa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class WaliKelasController extends Controller
{

    public function profilWalas(Tbl_user $tbl_user)
    {
        $auth = Auth::user();

        $data = [
            'akun' => $tbl_user
                ->join('guru', 'tbl_user.id_user', '=', 'guru.id_user')
                ->join('wali_kelas', 'guru.id_guru', '=', 'wali_kelas.id_guru')
                ->join('kelas', 'wali_kelas.id_walas', '=', 'kelas.id_walas')
                ->where('guru.id_user', $auth->id_user)->get()
                
        ];
        return view('profil.profilguru', $data);
    }

    public function indexSiswa(tbl_user $tbl_user, Siswa $siswa)
    {
        $totalsiswa = DB::select('SELECT CountSiswa() AS TotalSiswa');
        $auth = Auth::user()->id_user;
        // $tampilkan_siswa = DB::select(' SELECT * from view_siswa');
        if (Auth::check() && Auth::user()->role == 'tatausaha') {
            $tampilkan_siswa = DB::table('view_siswa')
                ->get();
        } else {
            $tampilkan_siswa = DB::table('view_siswa')
                ->join('kelas', 'view_siswa.id_kelas', '=', 'kelas.id_kelas')
                ->join('guru', 'guru.id_guru', '=', 'kelas.id_walas')
                ->where('guru.id_user', $auth)
                ->get();
        }
        // array untuk menangkap data siswa dari view dan 
        // menangkap data jumlah siswa dari stored function
        $data = [

            'siswa' => $tampilkan_siswa,
            'jumlah_siswa' => $totalsiswa[0]->TotalSiswa,
        ];

        // dd($data);


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

    public function detailKelas(Request $request, Kelas $kelas)
    {
        $detailkelas = DB::table('view_kelas')->where('id_kelas', $request->id)->get();
        $jumlahsiswa = DB::table('kelas')->select(DB::raw('COUNT(*) as JumlahSiswa'))
        ->join('siswa', 'siswa.id_kelas', '=', 'kelas.id_kelas')
        ->where('siswa.id_kelas', $request->id)->get();
        $data = [
            'detail' => $detailkelas,
                // ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
            'jumlahsiswa' => $jumlahsiswa[0]->JumlahSiswa
        ];
        // dd($data);
        return view('Kelas.detail', $data);
    }
    //================================================================


    public function indexPresensiSiswa(PresensiSiswa $presensi)
    {
        $auth = Auth::user()->id_user;
        $tampilkan_presensi = $presensi
            ->join('siswa', 'siswa.nis', '=', 'presensi_siswa.nis')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
            ->join('wali_kelas', 'wali_kelas.id_walas', '=', 'kelas.id_walas')
            ->join('guru', 'wali_kelas.id_guru', '=', 'guru.id_guru')
            ->where('guru.id_user', $auth)->get();
        // $tampilkan_presensi = DB::table('view_presensi')
        // ->where('guru.id_user', $auth)
        // ->get();

        $data = [
            'presensi' => $tampilkan_presensi
        ];

        // dd($data);

        return view('presensisiswa.index', $data);
    }

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
                return redirect('dashboard/walikelas/siswa')->with('success', 'Data Berhasil Diupdate');
            } else {
                return back()->with('error', 'Data Gagal Diupdate');
            }
        }
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
                return redirect('dashboard/walikelas/presensi')->with('success', 'Data berhasil diupdate');
            } else {
                return back()->with('error', 'Data gagal diupdate');
            }
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


    public function indexPengurus(PengurusKelas $pengurus)
    {
        $auth = Auth::user()->id_user;
        $tampilkan_pengurus = DB::select(' SELECT * from view_pengurus');
        $tampilkan_pengurus = $pengurus
        ->join('siswa', 'siswa.nis', '=', 'pengurus_kelas.nis')
        ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
        ->join('wali_kelas', 'wali_kelas.id_walas', '=', 'kelas.id_walas')
        ->join('guru', 'wali_kelas.id_guru', '=', 'guru.id_guru')
        ->where('guru.id_user', $auth)->get();


        $data = [
            'pengurus' => $tampilkan_pengurus
        ];
        return view('pengurus.index', $data);
    }

    public function createPengurus(Siswa $siswa, Kelas $kelas, tbl_user $tbl_user)
    {

        // $siswa = DB::select(' SELECT * from view_siswa');
        $auth = Auth::user()->id_user;
        $tampilkan_siswa = DB::table('view_siswa')
        ->join('kelas', 'view_siswa.id_kelas', '=', 'kelas.id_kelas')
        ->join('guru', 'guru.id_guru', '=', 'kelas.id_walas')
        ->where('guru.id_user', $auth)
        ->get();

        // dd($tampilkan_pengurus);
        return view("pengurus.tambah", ["siswa" => $tampilkan_siswa]);
    }


    public function storePengurus(Request $request, tbl_user $tbl_user)
    {
        $data = $request->validate(
            [
                'nis' => 'required',
                'jabatan' => 'required'
            ]
        );

        $store = DB::statement("CALL CreatePengurus(?,?)", [$data['nis'], $data['jabatan']]);
        if ($store) {
            $siswaId = $request->input('nis');
            $tbl_user->join('siswa', 'tbl_user.id_user', '=', 'siswa.id_user')
                ->where('siswa.nis', $siswaId)
                ->update(['tbl_user.role' => 'pengurus']);

            return redirect('dashboard/walikelas/pengurus');
        } else {
            return back()->with('error', 'Data pengurus gagal ditambahkan');
        }
    }


    public function editPengurus(Request $request, Siswa $siswa, PengurusKelas $pengurusKelas)
    {
        // $data = [
        //     // "siswa" => $siswa->where('nis', $request->id)->get(),
        //     // "jabatan" =>
        //     "pengurus" => 
        //         $pengurusKelas->
        //         join
        //         // ->where('nis', $request->id)->first()
        // ];

        $data = [
            "pengurus" => $pengurusKelas
                ->join('siswa', 'pengurus_kelas.nis', '=', 'siswa.nis')
                ->where('id_pengurus', '=', $request->id)
                ->first()
        ];

        // dd($data);
        return view('pengurus.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePengurus(Request $request, Siswa $siswa, PengurusKelas $pengurusKelas)
    {
        $id_pengurus = $request->id_pengurus;

        $data = $request->validate(
            [
                // 'nama_siswa' => 'sometimes',
                'jabatan' => 'sometimes',
            ]
        );

        // dd($data);
        if ($id_pengurus != null) {

            $dataUpdate = $pengurusKelas->where('id_pengurus', $id_pengurus)->update($data);
            if ($dataUpdate) {
                return redirect('dashboard/walikelas/pengurus')->with('success', 'Data Berhasil Diupdate');
            } else {
                return back()->with('error', 'Data Gagal Diupdate');
            }
        }
    }

    public function destroyPengurus(Request $request, PresensiSiswa $presensi,tbl_user $user, PengurusKelas $pengurusKelas)
    {
        $id_pengurus = $request->input('id_pengurus');
        $siswaid = PengurusKelas::where('id_pengurus', $id_pengurus)->value('nis');
        $hapusPengurus = $pengurusKelas->where('id_pengurus', $id_pengurus)->delete();

        if ($hapusPengurus) {

            $user->join('siswa', 'tbl_user.id_user', '=', 'siswa.id_user')
            ->where('siswa.nis', $siswaid)
            ->update(['tbl_user.role' => 'siswa']);

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

    public function unduhPresensi(Request $request, PresensiSiswa $presensi, Kelas $kelas)
    {
        $auth = Auth::user()->id_user;
        $presensi = $presensi
            ->join('siswa', 'siswa.nis', '=', 'presensi_siswa.nis')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id_kelas')
            ->join('wali_kelas', 'wali_kelas.id_walas', '=', 'kelas.id_walas')
            ->join('guru', 'wali_kelas.id_guru', '=', 'guru.id_guru')
            ->where('guru.id_user', $auth)->get();
        $pdf = PDF::loadView('presensisiswa.unduh', ['presensi' => $presensi]);
        return $pdf->download('data-presensi.pdf');
    }
}

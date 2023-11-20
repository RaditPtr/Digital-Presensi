<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\tbl_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class GuruController extends Controller
{
    public function index(Guru $guru){
        $totalGuru = DB::select('SELECT CountTotalDataGuru() AS totalGuru')[0]->totalGuru;

        $guru = DB::table('view_guru')->get();
        $data = [
            'user' => $guru,
            'jumlahGuru' => $totalGuru
        ];
        // dd($data);
        return view('guru.index', $data);
    }

    public function create(tbl_user $user)
    {
        $userAkun = $user->all();


        return view('guru.tambah', [
            'id_user' => $userAkun,
            'username' => $userAkun,
        ]);
    }

    public function store(Request $request, Guru $guru)
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
            return redirect('dashboard/guru')->with('success', 'Data Guru baru berhasil ditambah');
        } 

            return back()->with('error', 'Data jenis surat gagal ditambahkan');
    }

    public function edit(string $id, Guru $guru, tbl_user $user) {
        $guruData = Guru::where('id_guru', $id)->first();
        $userAkun = $user->all();

        return view('guru.edit', [
            'guru' => $guruData,
            'id_user' => $userAkun,
        ]);
    }

    public function update(Request $request, Guru $guru)
    {
        $selectedId = $request->input('id_jenis_surat');

        $data = $request->validate([
            'id_guru' => 'sometimes',
            'id_user' => 'sometimes',
            'nama_guru' => 'sometimes',
            'foto_guru' => 'sometimes'
        ]);

        if ($data['id_guru'] !== null) {
            if ($request->hasFile('foto_guru')) {
                $foto_file = $request->file('foto_guru');
                $foto_extension = $foto_file->getClientOriginalExtension();
                $foto_nama = md5($foto_file->getClientOriginalName() . time()) . '.' . $foto_extension;
                $foto_file->move(public_path('foto'), $foto_nama);

                $update_data = $guru->where('id_guru', $data['id_guru'])->first();
                File::delete(public_path('foto') . '/' . $update_data->foto_guru);

                $data['foto_guru'] = $foto_nama;
            }

            $data['id_user'] = $selectedId;

            $dataUpdate = $guru->where('id_guru', $data['id_guru'])->update($data);

            if ($dataUpdate) {
                return redirect('dashboard/guru')->with('success', 'Data Guru berhasil diupdate');
            } else {
                return back()->with('error', 'Data Guru gagal diupdate');
            }
        }
    }

    public function destroy(Guru $guru, Request $request) {
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

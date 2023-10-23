<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    //
    public function index(Guru $guru){
        $data = [
            'guru' => $guru->all()
        ];
        return view('dashboard.index', $data);
    }

    public function create()
    {
        return view('dashboard.tambah');
    }

    public function store(Request $request, Guru $guru)
    {
        $data = $request->validate([
            'id_guru' => 'required',
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
            return redirect('dashboard')->with('success', 'Data jenis surat baru berhasil ditambah');
        } 

            return back()->with('error', 'Data jenis surat gagal ditambahkan');
    }

    public function edit(string $id, Guru $guru) {
        $guruData = Guru::where('id_guru', $id)->first();

        return view('dashboard.edit', [
            'guru' => $guruData
        ]);
    }

    public function update(Request $request, Guru $guru)
    {
        $id_guru = $request->input('id_guru');

        $data = $request->validate([
            'nama_guru' => 'sometimes',
            'foto_guru' => 'sometimes'
        ]);

        if ($id_guru !== null) {
            if ($request->hasFile('foto_guru')) {
                $foto_file = $request->file('foto_guru');
                $foto_extension = $foto_file->getClientOriginalExtension();
                $foto_nama = md5($foto_file->getClientOriginalName() . time()) . '.' . $foto_extension;
                $foto_file->move(public_path('foto'), $foto_nama);

                $update_data = $guru->where('id_guru', $id_guru)->first();
                File::delete(public_path('foto') . '/' . $update_data->file);

                $data['foto_guru'] = $foto_nama;
            }

            $dataUpdate = $guru->where('id_guru', $id_guru)->update($data);

            if ($dataUpdate) {
                return redirect('dashboard')->with('success', 'Data Guru berhasil diupdate');
            }

            return back()->with('error', 'Data Guru gagal diupdate');
        }
    }

    public function destroy(Guru $guru, Request $request) {
        $id_guru = $request->input('id_guru');
        
        $aksi = $guru->where('id_guru', $id_guru)->delete();

        if($aksi) {
            $pesan = [
                'success' => true,
                'pesan' => 'Data Guru berhasil dihapus'
            ];
        } else {
            $pesan = [
                'success' => false,
                'pesan' => 'Data Guru gagal dihapus'
            ];
        }

        return response()->json($pesan);
    }
};

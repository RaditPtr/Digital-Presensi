<?php

namespace App\Http\Controllers;

use App\Models\tbl_user;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TblUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(tbl_user $akun)
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('akun.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, tbl_user $akun)
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
            return redirect('dashboard/akun')->with('success', 'Data user baru berhasil ditambah');
        } else {
            // Kembali ke form tambah data
            return back()->with('error', 'Data user gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(tbl_user $tbl_user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, tbl_user $akun)
    {
        $data = [
            'akun' =>  tbl_user::where('id_user', $id)->first()
        ];

        return view('akun.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, tbl_user $akun)
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(tbl_user $akun, Request $request)
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
}

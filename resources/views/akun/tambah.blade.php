@extends('layout.layout')
@section('title', 'Tambah Akun')
@section('content')
<style>
    body {
        background-color: #98E4FF;
    }    
</style>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="h1">
                        Tambah Data Akun
                    </span>
                </div>
                <div class="card-body">
                    <form method="POST" action="simpan" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="username" />
                                    <label>Password</label>
                                    <input type="text" class="form-control" name="password" />
                                    <label>Role</label>
                                    <select name="role" class="form-control">
                                        <option disabled selected>Pilih Role</option>
                                        <option value="tatausaha">Tata Usaha</option>
                                        <option value="walikelas">Wali Kelas</option>
                                    </select>
                                    @csrf
                                </div>
                                <div class="col-md-4 mt-3">
                                    <button type="submit" class="btn btn-primary">SIMPAN</button>
                                    <a href="#" onclick="window.history.back();" class="btn btn-success">KEMBALI</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

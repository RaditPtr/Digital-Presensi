@extends('layout.layout')
@section('title', 'Tambah Guru')
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
                        Tambah Data Guru 
                    </span>
                </div>
                <div class="card-body">
                    <form method="POST" action="simpan" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Id Akun</label>
                                    <select name="id_user" class="form-control">
                                        @foreach ($id_user as $us)
                                            <option value="{{ $us->id_user }}">{{ $us->id_user }} - {{ $us ->username}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label>Nama Guru</label>
                                    <input type="text" class="form-control" name="nama_guru" />
                                    <label>Foto Guru</label>
                                    <input type="file" class="form-control" name="foto_guru" />
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

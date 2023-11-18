@extends('layout.layout')
@section('title', 'Tambah Pengurus')
@section('content')
<style>
    body {
        background-color: #98E4FF;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header content-header">
                <span class="h1">
                    Tambah Pengurus
                </span>
            </div>
            <div class="card-body">
                <form method="POST" action="simpan" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Siswa</label>
                                <select name="nis" class="form-control">
                                    @foreach ($siswa as $s)
                                    <option value="{{ $s->nis }}">{{ $s->nama_siswa }}
                                    </option>
                                    @endforeach
                                </select>
                                <br>
                                <label>Jabatan</label>
                                <select name="jabatan" class="form-control">
                                    <option value="Ketua kelas">Ketua kelas</option>
                                    <option value="Wakil kelas">Wakil kelas</option>
                                    <option value="Sekretaris">Sekretaris</option>
                                    <option value="Bendahara">Bendahara</option>
                                </select>
                                @csrf
                            </div>
                            <div class="col-md-5 mt-3">
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
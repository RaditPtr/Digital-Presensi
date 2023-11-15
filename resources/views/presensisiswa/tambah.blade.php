@extends('layout.layout')
@section('title', 'Tambah Presensi')
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
                    Tambah Data Presensi
                </span>
            </div>
            <div class="card-body">
                <form method="POST" action="simpan" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Siswa</label>
                                <select name="id_siswa" class="form-control">
                                    @foreach ($siswa as $s)
                                    <option value="{{ $s->id_siswa }}">{{ $s->nama_siswa }}
                                    </option>
                                    @endforeach
                                </select>
                                <label>Status</label>
                                <select name="status_kehadiran" class="form-control">
                                    <option value="Hadir">Hadir</option>
                                    <option value="Izin">Izin</option>
                                    <option value="Alpha">Alpha</option>
                                </select>
                                <label>Foto Bukti</label>
                                <input type="file" class="form-control" name="foto_bukti" />
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
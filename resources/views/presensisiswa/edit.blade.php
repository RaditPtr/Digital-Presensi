@extends('layout.layout')
@section('title', 'Edit Presensi')
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
                    Edit Data Presensi
                </span>
            </div>
            <div class="card-body">
                <form method="POST" action="simpan" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Siswa</label>
                                <input type="text" class="form-control" disabled value="{{$presensi[0]->nama_siswa}}">
                                <label>Status</label>
                                <select name="status_hadir" class="form-control">
                                    <option value="Hadir" {{ $presensi[0]->status_hadir === "Hadir" ? 'selected' : '' }}>Hadir</option>
                                    <option value="Izin" {{ $presensi[0]->status_hadir === "Izin" ? 'selected' : '' }}>Izin</option>
                                    <option value="Alpha" {{ $presensi[0]->status_hadir === "Alpha" ? 'selected' : '' }}>Alpha</option>
                                </select>
                                <label>Foto Bukti</label>
                                <input type="hidden" class="form-control" name="id_presensi" value="{{$presensi[0]->id_presensi}}" />
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
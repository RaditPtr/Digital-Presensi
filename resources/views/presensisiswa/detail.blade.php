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
                    Detail Presensi
                </span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Nama Siswa</label>
                            <p>{{$detail[0]->nama_siswa}}</p>
                            <label>Kelas</label>
                            <p>{{$detail[0]->nama_kelas}}</p>
                            <label>Tanggal</label>
                            <p>{{$detail[0]->tanggal_presensi}}</p>
                            <label>Status</label>
                            <p>{{$detail[0]->status_kehadiran}}</p>
                            @if ($detail[0]->foto_bukti)
                            <label>Foto Siswa</label>
                            <br>
                            <img src="{{ url('foto') . '/' . $detail[0]->foto_bukti }} " style="max-width: 250px; height: auto;" />
                            @endif
                            @csrf
                        </div>
                        <div class="col-md-4 mt-3">
                            <a href="#" onclick="window.history.back();" class="btn btn-success">KEMBALI</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
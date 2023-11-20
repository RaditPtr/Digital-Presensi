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
            <div class="card-header content-header">
                <span class="h1">
                    Tambah Data Presensi
                </span>
            </div>
            <div class="card-body">
                <form method="POST" action="simpan" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                @if (Auth::check() && Auth::user()->role != 'siswa')
                                <label>Siswa</label>
                                <select name="nis" class="form-control">
                                    @foreach ($siswa as $s)
                                    <option value="{{ $s->nis }}">{{ $s->nama_siswa }}
                                    </option>
                                    @endforeach
                                </select>
                                @endif
                                @if (Auth::check() && Auth::user()->role == 'siswa')
                                <label>Siswa</label>
                                <input type="text" class="form-control" disabled value="{{$siswa[0]->nama_siswa}}">
                                <select hidden name="nis" class="form-control">
                                    @foreach ($siswa as $s)
                                    <option value="{{ $s->nis }}">{{ $s->nama_siswa }}
                                    </option>
                                    @endforeach
                                </select>
                                @endif
                                <label>Status</label>
                                <select name="status_hadir" class="form-control">
                                    <option value="Hadir">Hadir</option>
                                    <option value="Izin">Izin</option>
                                    @if (Auth::check() && Auth::user()->role != 'siswa')
                                        <option value="Alpha">Alpha</option>
                                    @endif
                                </select>
                                <label>Foto Bukti</label>
                                <input type="file" class="form-control" name="foto_bukti" />
                                @csrf
                            </div>
                            <div class="col-md-9 mt-3">
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
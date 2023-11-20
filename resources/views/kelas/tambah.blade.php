@extends('layout.layout')
@section('title', 'Tambah Siswa')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header content-header content-header">
                    <span class="h1">
                        Tambah Kelas
                    </span>
                </div>
                <div class="card-body">
                    <form method="POST" action="simpan" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Kelas</label>
                                    <input type="text" class="form-control" name="nama_kelas" />
                                    <br>
                                    <label>Jurusan</label>
                                    <select name="id_jurusan" class="form-control">
                                        @foreach ($datakelas['jurusan'] as $k)
                                            <option value="{{ $k->id_jurusan }}" {{ $loop->first ? 'selected' : '' }}>
                                                {{ $k->nama_jurusan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <label>Angkatan</label>
                                    <select name="id_angkatan" class="form-control">
                                        @foreach ($datakelas['angkatan'] as $k)
                                            <option value="{{ $k->id_angkatan }}" {{ $loop->first ? 'selected' : '' }}>
                                                {{ $k->id_angkatan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <label>Wali Kelas</label>
                                    <select name="id_walas" class="form-control">
                                        @foreach ($datakelas['walikelas'] as $k)
                                            <option value="{{ $k->id_walas }}" {{ $loop->first ? 'selected' : '' }}>
                                                {{ $k->nama_walikelas }}
                                            </option>
                                        @endforeach
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

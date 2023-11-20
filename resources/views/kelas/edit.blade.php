@extends('layout.layout')
@section('title', 'Edit Kelas')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <span class="h1">
                    Edit Data Kelas
                </span>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="simpan">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="col-md-4">
                                    <input type="hidden" name="id_kelas" value="{{ $kelas->id_kelas }}" />
                                </div>
                                <div class="form-group">
                                    <label>Nama Kelas</label>
                                    <input type="text" class="form-control" name="nama_kelas"
                                        value="{{ $kelas->nama_kelas }}" />
                                    <br>
                                    <label>Jurusan</label>
                                    <select name="id_jurusan" class="form-control">
                                        @foreach ($datakelas['jurusan'] as $j)
                                            <option value="{{ $j->id_jurusan }}"
                                                {{ $j->id_jurusan == $kelas->id_jurusan ? 'selected' : '' }}>
                                                {{ $j->nama_jurusan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <label>Angkatan</label>
                                    <select name="id_angkatan" class="form-control">
                                        @foreach ($datakelas['angkatan'] as $a)
                                            <option value="{{ $a->id_angkatan }}"
                                                {{ $a->id_angkatan == $kelas->id_angkatan ? 'selected' : '' }}>
                                                {{ $a->tahun_masuk }} - {{ $a->tahun_keluar }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <label>Wali Kelas</label>
                                    <select name="id_walas" class="form-control">
                                        @foreach ($datakelas['walikelas'] as $w)
                                            <option value="{{ $w->id_walas }}"
                                                {{ $w->id_walas == $kelas->id_walas ? 'selected' : '' }}>
                                                {{ $w->nama_walikelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <button type="submit" class="btn btn-primary">SIMPAN</button>
                                    <a href="#" onclick="window.history.back();" class="btn btn-success">KEMBALI</a>
                                </div>
                            </div>
                        </div>
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

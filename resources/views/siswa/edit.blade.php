@extends('layout.layout')
@section('title', 'Edit Siswa')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="h1">
                        Edit Data Siswa
                    </span>
                </div>
                <div class="card-body">
                    <form method="POST" action="simpan" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>NIS</label>
                                    <input type="text" class="form-control" name="nis" value="{{ $siswa->nis }}" />
                                    <div class="form-group">
                                        <label>Kelas</label>
                                        <select name="id_kelas" class="form-control">
                                            @foreach ($kelas as $i)
                                                <option value="{{ $i->id_kelas }}">
                                                    {{ $i->nama_kelas }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label>Nama Siswa</label>
                                    <input type="text" class="form-control" name="nama_siswa"
                                        value="{{ $siswa->nama_siswa }}" />
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-control">
                                            <option value="laki-laki"
                                                {{ $siswa->jenis_kelamin === 'laki-laki' ? 'selected' : '' }}>
                                                laki-laki</option>
                                            <option value="perempuan"
                                                {{ $siswa->jenis_kelamin === 'perempuan' ? 'selected' : '' }}>
                                                perempuan</option>
                                        </select>
                                    </div>
                                    <label>Foto Siswa</label>
                                    <input type="file" class="form-control" name="foto_siswa"
                                        value="{{ $siswa->foto_siswa }}" />
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

@extends('layout.layout')
@section('title', 'Edit Siswa')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h1>Edit Data Siswa</h1>
            </div>
            <div class="card-body">
                <form method="POST" action="simpan" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="nis">NIS</label>
                                <input type="text" class="form-control" name="nis" value="{{ $siswa->nis }}" id="nis">
                            </div>
                            <div class="form-group">
                                <label for="id_kelas">Kelas</label>
                                <select name="id_kelas" class="form-control" id="id_kelas">
                                    @foreach ($kelas as $i)
                                    <option value="{{ $i->id_kelas }}">
                                        {{ $i->nama_kelas }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama_siswa">Nama Siswa</label>
                                <input type="text" class="form-control" name="nama_siswa" value="{{ $siswa->nama_siswa }}" id="nama_siswa">
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control" id="jenis_kelamin">
                                    <option value="laki-laki" {{ $siswa->jenis_kelamin === 'laki-laki' ? 'selected' : '' }}>
                                        laki-laki
                                    </option>
                                    <option value="perempuan" {{ $siswa->jenis_kelamin === 'perempuan' ? 'selected' : '' }}>
                                        perempuan
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="foto_siswa">Foto Siswa</label>
                                <input type="file" class="form-control" name="foto_siswa" id="foto_siswa">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-3">
                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                        <a href="#" onclick="window.history.back();" class="btn btn-success">KEMBALI</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
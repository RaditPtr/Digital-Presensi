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
                    @csrf
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="nama_siswa">Nama Siswa</label>
                                <input type="text" class="form-control" name="nama_siswa" value="{{ $siswa->nama_siswa }}" id="nama_siswa">
                            </div>
                            <div class="form-group">
                                <label for="jabatan">Jabatan</label>
                                <select name="jabatan" class="form-control" id="jabatan">
                                    <option value="Ketua kelas" {{ $siswa->jabatan === 'Ketua Kelas' ? 'selected' : '' }}>
                                        Ketua kelas
                                    </option>
                                    <option value="Wakil kelas" {{ $siswa->jabatan === 'Wakil kelas' ? 'selected' : '' }}>
                                        Wakil kelas
                                    </option>
                                    <option value="Sekretaris" {{ $siswa->jabatan === 'Sekretaris' ? 'selected' : '' }}>
                                        Sekretaris
                                    </option>
                                    <option value="Bendahara" {{ $siswa->jabatan === 'Bendahara' ? 'selected' : '' }}>
                                        Bendahara
                                    </option>
                                </select>
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
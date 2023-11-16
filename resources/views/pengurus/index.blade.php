@extends('layout.layout')
@section('title', 'Daftar pengurus')
@section('content')

<div class="container">
    <h1>Kelola Siswa</h1>
    <div class="col-md-4">
        <a href="pengurus/tambah">
            <btn class="btn btn-success">Tambah Pengurus</btn>
        </a>

    </div>
    <table class="bootstrap-table table table-bordered">
        <thead>
            <tr>
                <th scope="col">NO</th>
                <th scope="col">Nama Pengurus</th>
                <th scope="col">Jabatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengurus as $e)
            <tr>
                <td>1</td>
                <td>{{ $e->nama_siswa }}</td>
                <td>{{ $e->jabatan }}</td>
                <td>
                    <!-- <a href="#" class="btn btn-primary btn-sm">Detail</a> -->
                    <a href="pengurus/edit/{{ $e->nis }}">
                        <btn class="btn btn-primary">EDIT</btn>
                    </a>
                    <btn class="btn btn-danger btnHapus" idNis="{{ $e->nis }}">HAPUS</btn>
                </td>
            </tr>
            @endforeach
        </tbody>


    </table>


</div>

@endsection
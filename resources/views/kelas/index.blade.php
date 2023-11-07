@extends('layout.layout')
@section('title', 'Daftar siswa')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card bg-white">
            <div class="card-header">
                <span class="h1">
                    Data siswa
                </span>
            </div>
            <div class="card-body">
                <div class="row">
                    <table class="table table-hover table-bordered DataTable">
                        <thead>
                            <tr>
                                <th>NAMA KELAS</th>
                                <th>WALI KELAS</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas as $k)
                            <tr>
                                <td>{{ $k->nama_kelas }}</td>
                                <td>{{ $k->nama_guru }}</td>
                                <td>
                                    <a href="#">
                                        <btn class="btn btn-primary">DETAIL</btn>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
</div>
@endsection
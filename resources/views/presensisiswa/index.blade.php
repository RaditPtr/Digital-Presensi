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
                                <th>NAMA SISWA</th>
                                <th>TANGGAL</th>
                                <th>STATUS HADIR</th>
                                <th>WAKTU PRESENSI</th>
                                <th>FOTO BUKTI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($presensisiswa as $p)
                            <tr>
                                <td>{{ $p->nama_siswa }}</td>
                                <td>{{ $p->tanggal_presensi }}</td>
                                <td>{{ $p->status_hadir}}</td>
                                <td>{{ $p->waktu_presensi}}</td>
                                <td>{{ $p->foto_bukti}}</td>
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
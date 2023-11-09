@extends('layout.layout')
@section('title', 'Daftar kelas')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card bg-white">
            <div class="card-header">
                <span class="h1">
                    Data Kelas
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
                                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">DETAIL</button>
                                    </a>
                                </td>
                            </tr>

                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Kelas</h1>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                        <div class="modal-body container">

                                            <div class="col-md-6">
                                                <div class="d-flex flex-column">

                                                    <h6 class="text-info">Nama Kelas</h6>
                                                    <h3>
                                                        {{ $k->nama_kelas }}
                                                    </h3>

                                                    <h6 class="text-info">Jurusan</h6>
                                                    <p>
                                                        {{ $k->nama_jurusan }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="d-flex flex-column">
                                                    <h6 class="text-info">Tahun Masuk & keluar</h6>
                                                    <p>
                                                        {{ $k->tahun_masuk }} dan {{ $k->tahun_keluar }}
                                                    </p>
                                                    <h6 class="text-info">Wali Kelas</h6>
                                                    <p>
                                                        {{ $k->nama_guru }}
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>


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
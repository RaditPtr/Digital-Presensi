@extends('layout.layout')
@section('title', 'Tambah Guru')
@section('content')
<style>
    /* body {
        background-color: #98E4FF;
    } */

    table {
        border: 1px solid transparent !important;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <span class="h1">
                    Detail Presensi
                </span>
            </div>
            <div class="card-body m-0">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="container">
                                <table class="table table-bordered mt-3">
                                    <tbody>
                                        <tr>
                                            <td class="fw-bolder">Nama Kelas</td>
                                            <td>: {{$detail[0]->nama_kelas}}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bolder">Nama Jurusan</td>
                                            <td>: {{$detail[0]->nama_jurusan}}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bolder">Tahun Masuk & Tahun Keluar</td>
                                            <td>: {{$detail[0]->tahun_masuk}} - {{$detail[0]->tahun_masuk}}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bolder">Wali Kelas</td>
                                            <td>: {{$detail[0]->nama_guru}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="col-md-4 mt-3">
                                    <a href="#" onclick="window.history.back();" class="btn btn-success">KEMBALI</a>
                                </div>
                            </div>

                            @csrf
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
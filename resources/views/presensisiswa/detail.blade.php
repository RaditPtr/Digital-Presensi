@extends('layout.layout')
@section('title', 'Detail Presensi')
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
                                            <td class="fw-bolder">Nama Siswa</td>
                                            <td>: {{$detail[0]->nama_siswa}}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bolder">Nama Kelas</td>
                                            <td>: {{$detail[0]->nama_kelas}}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bolder">Tanggal</td>
                                            <td>: {{$detail[0]->tanggal_presensi}}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bolder">Waktu Presensi</td>
                                            <td>: {{$detail[0]->waktu_presensi}}</td>
                                        </tr>

                                        <tr>
                                            <td class="fw-bolder">Status</td>
                                            <td>: {{$detail[0]->status_hadir}}</td>
                                        </tr>

                                        <tr>
                                            @if ($detail[0]->foto_bukti)
                                            <td class="fw-bolder">
                                                <label>Foto Bukti</label>
                                            <td><img src="{{ url('foto') . '/' . $detail[0]->foto_bukti }} " style="max-width: 250px; height: auto;" /></td>

                                            </td>

                                            @endif
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
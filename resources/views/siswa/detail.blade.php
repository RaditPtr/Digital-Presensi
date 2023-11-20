@extends('layout.layout')
@section('title', 'Detail Siswa')
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
            <div class="card-header content-header">
                <span class="h1">
                    Detail Siswa
                </span>
            </div>
            <div class="card-body m-0">
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <div class="container">
                                @if ($detail[0]->foto_siswa)
                                <div class="photo-container" style="border-radius: 50%;">
                                    <img src="{{ url('foto') . '/' . $detail[0]->foto_siswa }} " style="max-width: 250px; height: auto; border-radius: 50%" />
                                </div>
                                @endif
                                <table class="table table-bordered mt-3">
                                    <tbody>
                                        <tr>
                                            <td class="fw-bolder">NIS</td>
                                            <td>:{{$detail[0]->nis}}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bolder">Nama Siswa</td>
                                            <td>:{{$detail[0]->nama_siswa}}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bolder">Jenis Kelamin</td>
                                            <td>:{{$detail[0]->jenis_kelamin}}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bolder">Kelas</td>
                                            <td>:{{$detail[0]->nama_kelas}}</td>
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
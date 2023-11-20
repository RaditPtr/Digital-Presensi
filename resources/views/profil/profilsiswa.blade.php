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

    .card-body .row {
        width: 700px;
    }


    .photo-container {
        border: 3px solid #1616FF;
    }

    .col1 {
        width: 300px;
    }
</style>
<div class="row d-flex justify-content-center">
    <div class="col-md-7">
        <div class="card">
            <div class="card-body m-0 d-flex justify-content-center">

                <div class="form-group">
                    <div class="container d-flex flex-column mb-3">
                        <div class="p-2 d-flex justify-content-center">
                            @if ($akun[0]->foto_siswa)
                            <div class="photo-container p-2" style="border-radius: 50%;">
                                <img src="{{ url('foto') . '/' . $akun[0]->foto_siswa }} " style="max-width: 250px; height: auto;" />
                                <!-- <img src="boy1.jpg" style="max-width: 250px; height: auto;" /> -->
                                
                            </div>
                            @endif
                        </div>
                        <div class="p-2 d-flex justify-content-center">
                            <table class="table table-bordered mt-3">
                                <tbody>
                                    <tr>
                                        <td class="fw-bolder col1">Username</td>

                                        <td class="fw-bolder col1">Nama Siswa</td>
                                    </tr>
                                    <tr>

                                        <td class="col1">{{ $akun[0]->username }}</td>
                                        <td class="col1">{{ $akun[0]->nama_siswa }}</td>
                                    </tr>

                                    </tbody>
                                    <tbody>
                                        <tr>
                                            <td class="fw-bolder col1">Jenis Kelamin</td>
    
                                            <td class="fw-bolder col1">Kelas</td>
                                        </tr>
                                        <tr>
    
                                            <td class="col1">{{ $akun[0]->jenis_kelamin }}</td>
                                            <td class="col1">{{ $akun[0]->nama_kelas }}</td>
                                        </tr>
    
                                        </tbody>
                            </table>
                        </div>
                        <div class="p-2 d-flex justify-content-center">
                            <div class="col-md-4 mt-3 d-flex justify-content-center">
                                <a href="#" onclick="window.history.back();" class="btn btn-success">KEMBALI</a>
                            </div>
                        </div>



                    </div>

                    @csrf
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
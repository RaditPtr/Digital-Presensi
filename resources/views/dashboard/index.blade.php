@extends('layout.layout')
@section('title', 'Dashboard')
@section('content')
<style>
    body {
        background-color: #98E4FF;
    }

    .col-md-4 {
        padding-bottom: 20px;
    }

    .container {
        margin-top: 20px;

    }

    .card-body {
        height: 105px;
    }

    .card-body a {
        text-decoration: none;
        color: black;
    }
</style>
<div class="container">
    <div class="row">

        @if (Auth::check() && Auth::user()->role == 'walikelas')
        <div class="col-md-4">
            <div class="card text-center bg-white">
                <div class="card-body">
                    <a href="walikelas/siswa">
                        <h3 class="card-title">JUMLAH SISWA</h3>
                    </a>
                    <h1 class="fw-bold">{{ $jumlah_siswa_per_kelas }}</h1>
                </div>
                <img src="{{ asset('img/group.png') }}" class="card-img-top" alt="Card Image" style="max-width: 100px; max-height: 100px; margin: 0 auto;">
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center bg-white">
                <div class="card-body">
                    <a href="walikelas/kelas">
                        <h3 class="card-title">JUMLAH KELAS</h3>
                    </a>

                    <h1 class="fw-bold">{{ $jumlah_kelas }}</h1>
                </div>
                <img src="{{ asset('img/kelas.png') }}" class="card-img-top" alt="Card Image" style="max-width: 100px; max-height: 100px; margin: 0 auto;">
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center bg-white">
                <div class="card-body">
                    <a href="walikelas/pengurus">
                        <h3 class="card-title">JUMLAH PENGURUS</h3>
                    </a>

                    <h1 class="fw-bold">{{ $jumlah_pengurus_per_kelas }}</h1>
                </div>
                <img src="{{ asset('img/Senior_high_school_students.png') }}" class="card-img-top" alt="Card Image" style="max-width: 100px; max-height: 100px; margin: 0 auto;">
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-center bg-white">
                <div class="card-body">
                    <a href="walikelas/presensi">
                        <h3 class="card-title">JUMLAH PRESENSI</h3>
                    </a>

                    <h1 class="fw-bold">{{ $jumlah_presensi_per_kelas }}</h1>
                </div>
                <img src="{{ asset('img/teacher.png') }}" class="card-img-top" alt="Card Image" style="max-width: 100px; max-height: 100px; margin: 0 auto;">
            </div>
        </div>




        @elseif (Auth::check() && Auth::user()->role == 'gurubk')
        <div class="col-md-4">
            <div class="card text-center bg-white">
                <div class="card-body">
                    <a href="gurubk/siswa">
                        <h3 class="card-title">JUMLAH SISWA</h3>
                    </a>

                    <h1 class="fw-bold">{{ $jumlah_siswa }}</h1>
                </div>
                <img src="{{ asset('img/teacher.png') }}" class="card-img-top" alt="Card Image" style="max-width: 100px; max-height: 100px; margin: 0 auto;">
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center bg-white">
                <div class="card-body">
                    <a href="gurubk/kelas">
                        <h3 class="card-title">JUMLAH KELAS</h3>
                    </a>

                    <h1 class="fw-bold">{{ $jumlah_kelas }}</h1>
                </div>
                <img src="{{ asset('img/kelas.png') }}" class="card-img-top" alt="Card Image" style="max-width: 100px; max-height: 100px; margin: 0 auto;">
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center bg-white">
                <div class="card-body">
                    <a href="gurubk/presensi">
                        <h3 class="card-title">JUMLAH PRESENSI</h3>
                    </a>

                    <h1 class="fw-bold">{{ $jumlah_presensi }}</h1>
                </div>
                <img src="{{ asset('img/teacher.png') }}" class="card-img-top" alt="Card Image" style="max-width: 100px; max-height: 100px; margin: 0 auto;">
            </div>
        </div>
        @elseif (Auth::check() && Auth::user()->role == 'tatausaha')
        <div class="col-md-4">
            <div class="card text-center bg-white">
                <div class="card-body">
                    <a href="dashboard/siswa">
                        <h3 class="card-title">JUMLAH SISWA</h3>
                    </a>
                    <h1 class="fw-bold">{{ $jumlah_siswa }}</h1>
                </div>
                <img src="{{ asset('img/group.png') }}" class="card-img-top" alt="Card Image" style="max-width: 100px; max-height: 100px; margin: 0 auto;">
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center bg-white">
                <div class="card-body">
                    <h3 class="card-title">JUMLAH KELAS</h3>
                    <h1 class="fw-bold">721</h1>
                </div>
                <img src="{{ asset('img/kelas3.png') }}" class="card-img-top" alt="Card Image" style="max-width: 100px; max-height: 100px; margin: 0 auto;">
            </div>
        </div>
        @elseif (Auth::check() && Auth::user()->role == 'gurupiket')
        <div class="col-md-4">
            <div class="card text-center bg-white">
                <div class="card-body">
                    <a href="gurupiket/kelas">
                        <h3 class="card-title">JUMLAH KELAS</h3>
                    </a>

                    <h1 class="fw-bold">{{ $jumlah_kelas }}</h1>
                </div>
                <img src="{{ asset('img/kelas.png') }}" class="card-img-top" alt="Card Image" style="max-width: 100px; max-height: 100px; margin: 0 auto;">
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center bg-white">
                <div class="card-body">
                    <a href="gurupiket/siswa">
                        <h3 class="card-title">JUMLAH SISWA</h3>
                    </a>
                    <h1 class="fw-bold">{{ $jumlah_siswa }}</h1>
                </div>
                <img src="{{ asset('img/jumlah siswa.png') }}" class="card-img-top" alt="Card Image" style="max-width: 100px; max-height: 100px; margin: 0 auto;">
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center bg-white">
                <div class="card-body">
                    <a href="gurupiket/presensi">
                        <h3 class="card-title">JUMLAH PRESENSI</h3>
                    </a>

                    <h1 class="fw-bold">{{ $jumlah_presensi }}</h1>
                </div>
                <img src="{{ asset('img/teacher.png') }}" class="card-img-top" alt="Card Image" style="max-width: 100px; max-height: 100px; margin: 0 auto;">
            </div>
        </div>
        @elseif (Auth::check() && Auth::user()->role == 'siswa')
        <div class="col-md-4">
            <div class="card text-center bg-white">
                <div class="card-body">
                    <a href="siswa/presensi/tambah">
                        <h3 class="card-title">ISI <br> PRESENSI</h3>
                    </a>
                </div>
                <img src="{{ asset('img/teacher.png') }}" class="card-img-top" alt="Card Image" style="max-width: 100px; max-height: 100px; margin: 0 auto;">
            </div>
        </div>
        @endif
    </div>
</div>



@endsection

@section('footer')
<!-- <script type="module">
    $('.DataTable tbody').on('click', '.btnHapus', function(a) {
        a.preventDefault();
        let idGuru = $(this).closest('.btnHapus').attr('idGuru');
        swal.fire({
            title: "Apakah anda ingin menghapus data ini?",
            showCancelButton: true,
            confirmButtonText: 'Setuju',
            cancelButtonText: `Batal`,
            confirmButtonColor: 'red'

        }).then((result) => {
            if (result.isConfirmed) {
                //Ajax Delete
                $.ajax({
                    type: 'DELETE',
                    url: 'dashboard/hapus',
                    data: {
                        id_guru: idGuru,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if (data.success) {
                            swal.fire('Berhasil di hapus!', '', 'success').then(function() {
                                //Refresh Halaman
                                location.reload();
                            });
                        }
                    }
                });
            }
        });
    });
</script> -->

@endsection
@extends('layout.layout')
@section('title', 'Dashboard')
@section('content')
<style>
    body {
        background-color: #98E4FF;
    }
</style>
<div class="container">
    <div class="row">

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
                    <a href="dashboard/kelas">
                        <h3 class="card-title">JUMLAH KELAS</h3>
                    </a>
                    
                    <h1 class="fw-bold">{{ $jumlah_kelas }}</h1>
                </div>
                <img src="{{ asset('img/kelas3.png') }}" class="card-img-top" alt="Card Image" style="max-width: 100px; max-height: 100px; margin: 0 auto;">
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
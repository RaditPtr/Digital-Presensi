@extends('layout.layout')
@section('title', 'Daftar Presensi')
@section('content')
<style>
    body {
        background-color: #98E4FF;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <span class="h1 fw-bold">
                Daftar Presensi
            </span>
        </div>
        <div class="card bg-white">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <br>
                        @if (Auth::check() && Auth::user()->role == 'gurupiket')
                        <a href="presensi/tambah">
                            <btn class="btn btn-success">Tambah Presensi</btn>
                        </a>
                        @endif
                    </div>
                    <p>
                        <hr>
                    <table class="table table-hover table-bordered DataTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Siswa</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($presensi as $p)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $p->nama_siswa }}</td>
                                <td>{{ $p->tanggal_presensi }}</td>
                                <td>{{ $p->status_hadir }}</td>
                                <td>
                                    <a href="presensi/detail/{{$p->id_presensi}}">
                                        <btn class="btn btn-primary">Detail</btn>
                                    </a>
                                    @if (Auth::check() && Auth::user()->role == 'gurupiket')
                                    <a href="presensi/edit/{{$p->id_presensi}}">
                                        <btn class="btn btn-warning">Edit</btn>
                                    </a>
                                    <btn class="btn btn-danger btnHapus" idHapus="{{ $p->id_presensi }}">Hapus</btn>
                                    @endif
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

@section('footer')
<script type="module">
    $('.DataTable tbody').on('click', '.btnHapus', function(a) {
        a.preventDefault();
        let idHapus = $(this).closest('.btnHapus').attr('idHapus');
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
                    url: 'presensi/hapus',
                    data: {
                        id_presensi: idHapus,
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
</script>
@endsection
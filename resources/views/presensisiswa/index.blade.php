@extends('layout.layout')
@section('title', 'Daftar Presensi')
@section('content')
<style>
    body {
        background-color: #98E4FF;
    }

    .btnunduh {
        background-color: #CBCDF2;
    }

    .btnunduh:hover {
        background-color: #abacc7;
    }
</style>

<div class="container">
    <h1 class="content-header">Daftar Presensi</h1>
    <div class="col-md-2 d-flex justify-content-end">

        <a href="presensi/unduh" style="margin-right: 10px;">
            <btn class="btn btn-success button btntambah btnunduh">Unduh PDF
                <img src="{{asset('img/unduh.png')}}" style="max-width: 20px;">
            </btn>

        </a>
        <span></span>
        @if (Auth::check() && Auth::user()->role == 'gurupiket')
        <a href="presensi/tambah">
            <btn class="btn btn-success button btntambah">Tambah Presensi</btn>
        </a>
        @endif

    </div>
    <table class="bootstrap-table table table-bordered DataTable">
        <thead>
            <tr>
                <th scope="col" class="thead">No</th>
                <th scope="col" class="thead">Nama Siswa</th>
                <th scope="col" class="thead">Tanggal</th>
                <th scope="col" class="thead">Status</th>
                <th scope="col" class="thead">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($presensi as $p)
            <tr>
                <td>{{$loop->iteration}}</td>

                <td>{{ $p->nama_siswa }}</td>
                <td>{{ $p->tanggal_presensi }}</td>
                <td>{{ $p->status_hadir }}</td>
                <td class="listbtn">
                    <a href="presensi/detail/{{$p->id_presensi}}" class="btn btn-sm button btnDetail">
                        <p>Detail</p>
                    </a>
                    @if (Auth::check() && Auth::user()->role == 'gurupiket')
                    <a href="presensi/edit/{{$p->id_presensi}}">
                        <p class="btn btn-sm button btnEdit">Edit</p>
                    </a>
                    <btn class="btn btn-sm button btnHapus" idHapus="{{ $p->id_presensi }}">Hapus</btn>
                    @elseif (Auth::check() && Auth::user()->role == 'walikelas')
                    <a href="presensi/edit/{{$p->id_presensi}}">
                        <p class="btn btn-sm button btnEdit">Edit</p>
                    </a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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
    $(document).ready(function() {
            $('.DataTable').DataTable();
        });
</script>
@endsection
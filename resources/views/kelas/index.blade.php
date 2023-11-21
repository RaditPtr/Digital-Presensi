@extends('layout.layout')
@section('title', 'Daftar kelas')
@section('content')

<div class="container">
    <h1 class="content-header">Daftar Kelas</h1>
    <div class="col-md-2">
        @if (Auth::check() && Auth::user()->role == 'tatausaha')
        <a href="kelas/tambah">
            <btn class="btn btn-success button btntambah content-header">Tambah Kelas</btn>
        </a>
        <a href="kelas/unduh">
            <btn class="btn btn-success button btntambah content-header">Unduh pdf</btn>
        </a>
        @endif

    </div>
    <table class="bootstrap-table table table-bordered DataTable">
        <thead>
            <tr>
                <th scope="col" class="thead">No</th>
                <th scope="col" class="thead">Nama Kelas</th>
                <th scope="col" class="thead">Wali Kelas</th>
                <th scope="col" class="thead">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kelas as $k)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $k->nama_kelas }}</td>
                <td>{{ $k->nama_guru }}</td>
                <td class="listbtn">
                    <a href="kelas/detail/{{$k->id_kelas}}" class="btn btn-sm button btnDetail">
                        <p>Detail</p>
                    </a>
                    @if (Auth::check() && Auth::user()->role == 'tatausaha')
                    <a href="kelas/edit/{{ $k->id_kelas }}" class="btn btn-sm button btnEdit">
                        <p>Edit</p>
                    </a>
                    <btn class="btn btn-sm button btnHapus" idKelas="{{ $k->id_kelas }}">HAPUS</btn>
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
            let idKelas = $(this).closest('.btnHapus').attr('idKelas');
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
                        url: 'kelas/hapus',
                        data: {
                            id_kelas: idKelas,
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
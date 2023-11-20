@extends('layout.layout')
@section('title', 'Daftar siswa')
@section('content')
<style>
    .photo-container {
        overflow: hidden;
        width: 150px;
        height: 200px;
    }

    .listbtn {
        height: 220px !important;
    }
</style>


<div class="container">
    <h1 class="content-header">Daftar Siswa</h1>
    <div class="col-md-2">

        <a href="siswa/tambah">
            <btn class="btn btn-success button btntambah">
                <p>Tambah Siswa</p>
            </btn>
        </a>

    </div>
    <table class="bootstrap-table table table-bordered">
        <thead>
            <tr>
                <th scope="col" class="thead">NO</th>
                <th scope="col" class="thead">Foto</th>
                <th scope="col" class="thead">Nis</th>
                <th scope="col" class="thead">Nama Lengkap</th>
                <th scope="col" class="thead">Jenkel</th>
                <th scope="col" class="thead">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($siswa as $s)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>
                    @if ($s->foto_siswa)
                    <div class="photo-container">
                        <img src="{{ url('foto') . '/' . $s->foto_siswa }} " style="max-width: 250px; height: auto;" />
                        @endif
                    </div>
                </td>
                <td class="text-align: center;">{{ $s->nis }}</td>
                <td>{{ $s->nama_siswa }}</td>
                <td>{{ $s->jenis_kelamin }}</td>
                <td class="listbtn">
                    <a href="siswa/detail/{{$s->nis}}" class="btn btn-sm button btnDetail">
                        <p>Detail</p>
                    </a>
                    <a href="siswa/edit/{{ $s->nis }}">
                        <btn class="btn btn-sm button btnedit">Edit</btn>
                    </a>
                    @if (Auth::check() && Auth::user()->role == 'tatausaha')
                    <btn class="btn btn-sm button btnHapus" idNis="{{ $s->nis }}">Hapus</btn>
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
    $('.bootstrap-table tbody').on('click', '.btnHapus', function(a) {
        a.preventDefault();
        let idNis = $(this).closest('.btnHapus').attr('idNis');
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
                    url: 'siswa/hapus',
                    data: {
                        nis: idNis,
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

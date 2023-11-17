@extends('layout.layout')
@section('title', 'Daftar pengurus')
@section('content')

<div class="container">
    <h1>Kelola Siswa</h1>
    <div class="col-md-4">
        <a href="pengurus/tambah">
            <btn class="btn btn-success">Tambah Pengurus</btn>
        </a>

    </div>
    <table class="bootstrap-table table table-bordered DataTable">
        <thead>
            <tr>
                <th scope="col">NO</th>
                <th scope="col">Nama Pengurus</th>
                <th scope="col">Jabatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengurus as $e)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $e->nama_siswa }}</td>
                <td>{{ $e->jabatan }}</td>
                <td>{{$e->id_pengurus}}</td>
                <td>
                    <!-- <a href="#" class="btn btn-primary btn-sm">Detail</a> -->
                    <a href="pengurus/edit/{{ $e->id_pengurus }}">
                        <btn class="btn btn-primary">EDIT</btn>
                    </a>
                    <btn class="btn btn-danger btnHapus" idHapus="{{ $e->id_pengurus }}">HAPUS</btn>
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
        let id_pengurus = $(this).closest('.btnHapus').attr('idHapus');
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
                    url: 'pengurus/hapus',
                    data: {
                        id_pengurus: id_pengurus,
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
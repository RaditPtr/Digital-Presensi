@extends('layout.layout')
@section('title', 'Daftar pengurus')
@section('content')

<div class="container">
    <h1 class="content-header content-header">Daftar Pengurus</h1>
    <div class="col-md-2">
        <a href="pengurus/tambah">
            <btn class="btn btn-success button btntambah">Tambah Pengurus</btn>
        </a>

    </div>
    <table class="bootstrap-table table table-bordered DataTable">
        <thead>
            <tr>
                <th scope="col" class="thead">NO</th>
                <th scope="col" class="thead">Nama Pengurus</th>
                <th scope="col" class="thead">Jabatan</th>
                <th scope="col" class="thead">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengurus as $e)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{ $e->nama_siswa }}</td>
                <td>{{ $e->jabatan }}</td>
                <td class="listbtn">
                    <a href="pengurus/edit/{{ $e->id_pengurus }}" class="btn btn-sm button btnEdit">
                        <p>Edit</p>
                    </a>
                    <btn class="btn btn-sm button btnHapus" idHapus="{{ $e->id_pengurus }}">HAPUS</btn>
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
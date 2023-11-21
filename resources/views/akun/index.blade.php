@extends('layout.layout')
@section('title', 'Daftar Akun')
@section('content')

<div class="container">
    <h1 class="content-header">Daftar Akun</h1>
    <div class="row align-items-center">
        <div class="col-md-6">
            <span class="h4">
                Jumlah Akun yang telah dibuat: {{ $jumlahAkun }}
            </span>
        </div>
        <div class="col-md-6 text-end">
            <a href="akun/tambah">
                <btn class="btn btn-success button btntambah content-header">Tambah Akun</btn>
            </a>
        </div>
    </div>
    <table class="bootstrap-table table table-bordered DataTable">
        <thead>
            <tr>
                <th scope="col" class="thead">Nama</th>
                <th scope="col" class="thead">Role</th>
                <th scope="col" class="thead">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($akun as $a)
                <tr>
                    <td>{{ $a->username }}</td>
                    <td>{{ $a->role }}</td>
                    <td class="listbtn">
                        <a href="akun/edit/{{ $a->id_user }}"><button class="btn btn-sm button btnEdit">EDIT</button></a>
                        <button class="btn btn-sm button btnHapus" idUser="{{ $a->id_user }}">HAPUS</button>
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
            let idUser = $(this).closest('.btnHapus').attr('idUser');
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
                        url: 'akun/hapus',
                        data: {
                            id_user: idUser,
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

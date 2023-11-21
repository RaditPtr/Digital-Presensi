@extends('layout.layout')
@section('title', 'Daftar Guru')
@section('content')

    <div class="container">
        <h1 class="content-header">Daftar Guru</h1>
        <div class="row align-items-center">
            <div class="col-md-6">
                <span class="h4">
                    Jumlah Guru yang telah dibuat: {{ $jumlahGuru }}
                </span>
            </div>
            <div class="col-md-6 text-end">
                <a href="guru/tambah">
                    <btn class="btn btn-success button btntambah content-header">Tambah Guru</btn>
                </a>
            </div>
        </div>
        <table class="bootstrap-table table table-bordered DataTable">
            <thead>
                <tr>
                    <th scope="col" class="thead">Nama Guru</th>
                    <th scope="col" class="thead">Foto Guru</th>
                    <th scope="col" class="thead">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user as $g)
                    <tr>
                        <td>{{ $g->nama_guru }}</td>
                        <td>
                            @if ($g->foto_guru)
                                <img src="{{ url('foto') . '/' . $g->foto_guru }} "
                                    style="max-width: 250px; height: auto;" />
                            @endif
                        </td>
                        <td class="listbtn">
                            <a href="edit/{{ $g->id_guru }}">
                                <btn class="btn btn-sm button btnEdit">EDIT</btn>
                            </a>
                            <btn class="btn btn-sm button btnHapus" idGuru="{{ $g->id_guru }}">HAPUS</btn>
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
            let idGuru = $(this).closest('.btnHapus').attr('idGuru');

            console.log("ID Guru yang dikirim: " + idGuru);
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
                        url: 'guru/hapus',
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
        $(document).ready(function() {
            $('.DataTable').DataTable();
        });
    </script>

@endsection

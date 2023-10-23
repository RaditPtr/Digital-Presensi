@extends('layout.layout')
@section('title', 'Daftar Guru')
@section('content')




<div class="row">
    <div class="col-md-12">
        <div class="card bg-white">
            <div class="card-header">
                <span class="h1">
                    Data siswa
                </span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <a href="dashboard/tambah">
                            <btn class="btn btn-success">Tambah Siswa</btn>
                        </a>

                    </div>
                    <p>
                        <hr>
                    <table class="table table-hover table-bordered DataTable">
                        <thead>
                            <tr>
                                <th>NIS</th>
                                <th>NAMA SISWA</th>
                                <th>JENIS KELAMIN</th>
                                <th>FOTO SISWA</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($guru as $g)
                            <tr>
                                <td>{{ $g->id_guru }}</td>
                                <td>{{ $g->nama_guru }}</td>
                                <td>{{ $g->jenis_kelamin }}</td>
                                <td>
                                    @if ($g->foto_guru)
                                    <img src="{{ url('foto') . '/' . $g->foto_guru }} " style="max-width: 250px; height: auto;" />
                                    @endif
                                </td>
                                <td>
                                    <a href="dashboard/edit/{{ $g->id_guru }}">
                                        <btn class="btn btn-primary">EDIT</btn>
                                    </a>
                                    <btn class="btn btn-danger btnHapus" idGuru="{{ $g->id_guru }}">HAPUS</btn>
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
</script>

@endsection
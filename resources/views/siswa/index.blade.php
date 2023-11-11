@extends('layout.layout')
@section('title', 'Daftar siswa')
@section('content')

<div class="row">

            <div class="card-header">
                <span class="h1">
                    Data siswa
                </span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <a href="siswa/tambah">
                            <btn class="btn btn-success">Tambah Siswa</btn>
                        </a>
                        <h3>jumlah siswa : {{ $jumlah_siswa }}</h3>

                    </div>
                    <p>
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
                            @foreach ($siswa as $s)
                            <tr>
                                <td>{{ $s->nis }}</td>
                                <td>{{ $s->nama_siswa }}</td>
                                <td>{{ $s->jenis_kelamin }}</td>
                                <td>
                                    @if ($s->foto_siswa)
                                    <img src="{{ url('foto') . '/' . $s->foto_siswa }} " style="max-width: 250px; height: auto;" />
                                    @endif
                                </td>
                                <td>
                                    <a href="siswa/edit/{{ $s->nis }}">
                                        <btn class="btn btn-primary">EDIT</btn>
                                    </a>
                                    <btn class="btn btn-danger btnHapus" idNis="{{ $s->nis }}">HAPUS</btn>
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
@endsection

@section('footer')
<script type="module">
    $('.DataTable tbody').on('click', '.btnHapus', function(a) {
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









<!-- <div class="row">
    <div class="col-sm-10">
        <form class="form-inline" style="margin-bottom:10px;">
            <input type="text" name="" class="form-control">
            <button type="submit" class="btn btn-primary" style="margin-left:10px;">Submit</button>
        </form>
    </div>

    <div class="col-sm-2">
        <a href="http://localhost/belajarkeamanan_XIIRPLB_2122_21?aksi=form" class="btn btn-success float-right">Tambah</a>
    </div>

</div>

<div class="row">
    <div class="col-sm-12">
        <table class="table table-striped table-bordered">
            <tr class="thead-light">
                <th>No</th>
                <th>Judul Buku</th>
                <th>Kategori</th>
                <th>Penerbit</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
            <tr>
                <td>
                    1234
                </td>
                <td>
                    Lorem ipsum dolor sit amet.
                </td>
                <td>
                    Lorem.
                </td>
                <td>
                    Lorem, ipsum.
                </td>
                <td>
                    <img src="assets/img/" class="rounded" style="width:100px;">
                </td>
                <td>
                    <a href="" class="btn btn-primary">Detail</a>
                    <a href="" class="btn btn-warning">Edit</a>
                    <a href="" onclick="return confirm('Yakin akan hapus data?')" class="btn btn-danger">Hapus</a>
                </td>
            </tr>

        </table>

        <ul class="pagination justify-content-center">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>

    </div>
</div>
</div> -->
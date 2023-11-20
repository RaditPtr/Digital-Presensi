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

        @if (Auth::check() && Auth::user()->role == 'tatausaha')

        <a href="siswa/tambah">
            <btn class="btn btn-success button btntambah">
                <p>Tambah Siswa</p>
            </btn>
        </a>
        @endif
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
                    @if (Auth::check() && Auth::user()->role == 'tatausaha' || Auth::check() && Auth::user()->role == 'walikelas')
                    <a href="siswa/edit/{{ $s->nis }}">
                        <btn class="btn btn-sm button btnedit">Edit</btn>
                    </a>
                    @endif
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
@extends('layout.layout')
@section('title', 'Daftar siswa')
@section('content')
<style>
    .btntambah {
        background-color: #6FF745;
        text-align: center;
        width: 150px !important;
        height: 35px !important;

    }

    .button {
        text-align: center;
        width: 100px;
        height: 30px;
        border-radius: 5px;

        color: white;
        font-size: 16px;
        cursor: pointer;
        font-weight: 800;
        transition: all 0.2s ease-in-out;
        border: 1px solid black;
        font-size: 14.5;
        color: black;
        border-radius: 10px;
    }

    .btnDetail {
        background-color: #7EE6B9;
    }

    .btnDetail:hover {
        background-color: #23a881;
    }

    .btnEdit {
        background-color: #EAED2B;
    }

    .btnEdit:hover {
        background-color: #c2c429;
    }

    .btnHapus {
        background-color: #DB3223;
    }

    .btnHapus:hover {
        background-color: #a62a1f;
    }

    .button:hover {
        color: black;
    }

    .button:active {
        background-color: #1f8e6b;
    }

    .listbtn {
        display: flex;
        justify-content: space-around;
    }

    .col-md-2 {
        padding-left: 3%;
        float: right;
    }

    .photo-container {
        overflow: hidden;
        width: 150px;
        height: 200px;
    }

</style>



<div class="container">
    <h1>Kelola Siswa</h1>
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
                <th scope="col">NO</th>
                <th scope="col">Foto</th>
                <th scope="col">Nis</th>
                <th scope="col">Nama Lengkap</th>
                <th scope="col">Jenkel</th>
                @if (Auth::check() && Auth::user()->role == 'tatausaha')
                <th scope="col">Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($siswa as $s)
            <tr>
                <td>1</td>
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
                @if (Auth::check() && Auth::user()->role == 'tatausaha')
                <td class="listbtn">
                    <a href="#" class="btn btn-sm button btnDetail">
                        <p>Detail</p>
                    </a>
                    <a href="siswa/edit/{{ $s->nis }}">
                        <btn class="btn btn-sm button btnedit">Edit</btn>
                    </a>
                    <btn class="btn btn-sm button btnHapus" idNis="{{ $s->nis }}">Hapus</btn>
                </td>
                @endif
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
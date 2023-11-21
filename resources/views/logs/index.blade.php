@extends('layout.layout')
@section('title', 'Daftar Guru')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span class="h1">
                            Data Log Activity
                        </span>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <table class="table table-hover table-bordered DataTable mt-2">
                                        <thead>
                                            <tr>
                                                <th>Aktivitas</th>
                                                <th>Tanggal</th>
                                                <th>Waktu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($logsy as $tx)
                                                <tr>
                                                    <td>Terjadi Aksi {{ $tx->aksi }} Yg {{ $tx->record}} Di Tabel {{ $tx->tabel }}</td>
                                                    <td>{{ $tx->tanggal }}</td>
                                                    <td>{{ $tx->jam }}</td>
                                                    
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer">
    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        document.getElementById('checkAll').addEventListener('click', function() {
            var checkbox = document.querySelectorAll('.checkbox');
            for (var i = 0; i < checkbox.length; i++) {
                checkbox[i].checked = !checkbox[i].checked;
            }
        })
    </script>
@endsection
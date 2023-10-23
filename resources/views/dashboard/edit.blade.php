@extends('layout.layout')
@section('title', 'Edit Guru ')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="h1">
                        Edit Data Guru
                    </span>
                </div>
                <div class="card-body">
                    <form method="POST" action="simpan" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Nama Guru</label>
                                    <input type="text" class="form-control" name="nama_guru"
                                        value="{{ $guru->nama_guru }}" />
                                </div>
                                <div class="form-group">
                                    <label>Foto Guru</label>
                                    <input type="file" class="form-control" name="foto_guru" />
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="id_guru" value="{{ $guru->id_guru }}" />
                                </div>
                                @csrf
                                <div class="col-md-4 mt-3">
                                    <button type="submit" class="btn btn-primary">SIMPAN</button>
                                    <a href="#" onclick="window.history.back();" class="btn btn-success">KEMBALI</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

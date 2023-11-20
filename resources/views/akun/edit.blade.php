@extends('layout.layout')
@section('title', 'Edit Akun')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <span class="h1">
                    Edit Data Akun
                </span>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="simpan">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="col-md-4">
                                    <input type="hidden" name="id_user" value="{{ $akun->id_user }}" />
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username"
                                        value="{{ $akun->username }}" />
                                    @csrf
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" class="form-control" name="password" />
                                </div>
                                <div class="form-group">
                                    <label>Role</label>
                                    <select name="role" class="form-control">
                                        <option value="tatausaha" {{ $akun->role === 'tatausaha' ? 'selected' : '' }}>Tata Usaha
                                        </option>
                                    </select>
                                </div>
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

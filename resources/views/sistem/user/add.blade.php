@extends('sistem.layouts.app')
@include('sistem.layouts.partials.css')
@include('sistem.layouts.partials.js')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">User Management</h5>
            {!! Form::open(['method' => 'post', 'route' => ['sistem.user.store'], 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group mb-3">
                    <label for="" class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    <i class="text-danger">{{ $errors->first('name') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Role</label>
                    <select name="role" class="form-control">
                        <option value="">- Pilih -</option>
                        <option value="Pegawai">Pegawai</option>
                        <option value="Administrator">Administrator</option>
                    </select>
                    <i class="text-danger">{{ $errors->first('role') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Foto</label>
                    <input type="file" name="foto" class="form-control">
                    <i class="text-danger">{{ $errors->first('foto') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                    <i class="text-danger">{{ $errors->first('email') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" value="{{ old('username') }}">
                    <i class="text-danger">{{ $errors->first('username') }}</i>
                </div>
                <div class="form-group mb-4">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                    <i class="text-danger">{{ $errors->first('password') }}</i>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('sistem.user') }}" class="btn btn-warning">Back</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
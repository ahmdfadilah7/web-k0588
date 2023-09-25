@extends('sistem.layouts.app')
@include('sistem.layouts.partials.css')
@include('sistem.layouts.partials.js')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Bank</h5>
            {!! Form::open(['method' => 'post', 'route' => ['sistem.bank.store'], 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group mb-3">
                    <label for="" class="form-label">Name Bank</label>
                    <input type="text" name="name_bank" class="form-control" value="{{ old('name_bank') }}">
                    <i class="text-danger">{{ $errors->first('name_bank') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Logo</label>
                    <input type="file" name="logo" class="form-control">
                    <i class="text-danger">{{ $errors->first('logo') }}</i>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('sistem.bank') }}" class="btn btn-warning">Back</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
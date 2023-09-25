@extends('sistem.layouts.app')
@include('sistem.layouts.partials.css')
@include('sistem.layouts.partials.js')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Meja</h5>
            {!! Form::model($meja, ['method' => 'post', 'route' => ['sistem.meja.update', $meja->id], 'enctype' => 'multipart/form-data']) !!}
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $meja->name }}">
                    <i class="text-danger">{{ $errors->first('name') }}</i>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('sistem.meja') }}" class="btn btn-warning">Back</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
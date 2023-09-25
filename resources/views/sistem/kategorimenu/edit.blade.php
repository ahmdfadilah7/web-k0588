@extends('sistem.layouts.app')
@include('sistem.layouts.partials.css')
@include('sistem.layouts.partials.js')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Kategori Menu</h5>
            {!! Form::model($kategorimenu, ['method' => 'post', 'route' => ['sistem.kategorimenu.update', $kategorimenu->id], 'enctype' => 'multipart/form-data']) !!}
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="" class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $kategorimenu->title }}">
                    <i class="text-danger">{{ $errors->first('title') }}</i>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('sistem.kategorimenu') }}" class="btn btn-warning">Back</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
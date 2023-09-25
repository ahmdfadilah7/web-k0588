@extends('sistem.layouts.app')
@include('sistem.layouts.partials.css')
@include('sistem.layouts.partials.js')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Rekening</h5>
            {!! Form::open(['method' => 'post', 'route' => ['sistem.rekening.store'], 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group mb-3">
                    <label for="" class="form-label">Bank</label>
                    <select name="bank_id" class="form-control">
                        <option value="0">- Pilih -</option>
                        @foreach ($bank as $value)
                            <option value="{{ $value->id }}">{{ $value->name_bank }}</option>
                        @endforeach
                    </select>
                    <i class="text-danger">{{ $errors->first('bank_id') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Name Rekening</label>
                    <input type="text" name="name_rekening" class="form-control" value="{{ old('name_rekening') }}">
                    <i class="text-danger">{{ $errors->first('name_rekening') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">No Rekening</label>
                    <input type="text" name="no_rekening" class="form-control" value="{{ old('no_rekening') }}">
                    <i class="text-danger">{{ $errors->first('no_rekening') }}</i>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('sistem.rekening') }}" class="btn btn-warning">Back</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
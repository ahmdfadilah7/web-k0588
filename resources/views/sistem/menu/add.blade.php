@extends('sistem.layouts.app')
@include('sistem.layouts.partials.css')
@include('sistem.layouts.partials.js')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Menu</h5>
            {!! Form::open(['method' => 'post', 'route' => ['sistem.menu.store'], 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group mb-3">
                    <label for="" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                    <i class="text-danger">{{ $errors->first('name') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Kategori Menu</label>
                    <select name="kategorimenu_id" class="form-control">
                        <option value="0">- Pilih -</option>
                        @foreach ($kategorimenu as $value)
                            <option value="{{ $value->id }}">{{ $value->title }}</option>
                        @endforeach
                    </select>
                    <i class="text-danger">{{ $errors->first('kategorimenu_id') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Price</label>
                    <input type="number" name="price" class="form-control" value="{{ old('price') }}">
                    <i class="text-danger">{{ $errors->first('price') }}</i>
                </div>
                <div class="form-group mb-3">
                    <label for="" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" value="{{ old('image') }}">
                    <i class="text-danger">{{ $errors->first('image') }}</i>
                </div>
                <div class="form-group mb-4">
                    <label for="" class="form-label">Description</label>
                    <textarea name="description" class="ckeditor form-control" rows="5"></textarea>
                    <i class="text-danger">{{ $errors->first('description') }}</i>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('sistem.menu') }}" class="btn btn-warning">Back</a>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('script')
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>
@endsection
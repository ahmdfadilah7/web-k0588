@extends('layouts.app')
@include('layouts.partials.css')
@include('layouts.partials.js')

@section('content')

<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>{{ $setting->name_website }}</p>
                    <h1>Menu</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb section -->

<!-- products -->
<div class="product-section mt-150 mb-150">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                @if($msg = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <p>{{ $msg }}</p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @elseif ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        @foreach($errors->all() as $msg)
                            <p>{{ $msg }}</p>
                        @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="product-filters">
                    <ul>
                        <li class="active" data-filter="*">All</li>
                        @foreach ($kategorimenu as $value)
                            <li data-filter=".{{ strtolower(str_replace(' ', '-', $value->title)) }}">{{ $value->title }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="row product-lists">

            @foreach ($menu as $value)                
                <div class="col-lg-4 col-md-6 text-center {{ strtolower(str_replace(' ', '-', $value->kategorimenu)) }}">
                    <div class="single-product-item">
                        <div class="product-image">
                            <a href="{{ route('menu.detail', ['id' => $value->id, 'slug' => str_replace(' ', '-', $value->name)]) }}">
                                <img src="{{ url($value->image) }}" style="width:250px; height:250px;">
                            </a>
                        </div>
                        <a href="{{ route('menu.detail', ['id' => $value->id, 'slug' => str_replace(' ', '-', $value->name)]) }}">
                            <h3>{{ $value->name }}</h3>
                        </a>
                        <p class="product-price"><span>Harga</span> Rp. {{ number_format($value->price) }} </p>
                        @if(Str::length(Auth::guard('webmeja')->user()) > 0)
                            <a class="cart-btn" onclick="get_menu({{ $value->id }})"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                        @endif
                    </div>
                </div>
            @endforeach

        </div>

        @if(Request::segment(1) <> 'search')
            <div class="row">
                <div class="col-lg-12 text-center">
                    {{ $menu->links() }}                
                </div>
            </div>
        @endif
    </div>
</div>
<!-- end products -->

@include('home.partials.add_cart')

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var price = $('#menuPrice').val()
            var quantity = $('#quantity').val()
            var total = parseInt(price)*parseInt(quantity)
            if (price=='' || price==null) {
                $('#totalPrice').val(0)
            } else {
                $('#totalPrice').val(total)
            }
        })

        function get_menu(id) {
            var url = '{{ url("get_menu") }}/'+id
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#addcartModal').modal('show')
                    $('#menuId').val(data.id)
                    $('#menuName').val(data.name)
                    $('#menuPrice').val(data.price)
                }
            });
        }

        function plus() {
            let number = document.querySelector('[name="quantity"]');
            let numberplus = number.value = parseInt(number.value) + 1;
            var price = $('#menuPrice').val()
            var quantity = numberplus
            var total = parseInt(price)*parseInt(quantity)
            $('#totalPrice').val(total)
        }

        function minus() {
            let number = document.querySelector('[name="quantity"]');
                if (parseInt(number.value) > 0) {
                let numberminus = number.value = parseInt(number.value) - 1;
                var price = $('#menuPrice').val()
                var quantity = numberminus
                var total = parseInt(price)*parseInt(quantity)
                $('#totalPrice').val(total)
            }
        }


        $('#quantity').keyup(function() {
            var price = $('#menuPrice').val()
            var quantity = $('#quantity').val()
            var total = parseInt(price)*parseInt(quantity)
            $('#totalPrice').val(total)
        })
    </script>
@endsection
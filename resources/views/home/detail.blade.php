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

<!-- single product -->
<div class="single-product mt-150 mb-150">
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
            </div>
            <div class="col-md-5">
                <div class="single-product-img">
                    <img src="{{ url($menu->image) }}" alt="">
                </div>
            </div>
            <div class="col-md-7">
                <div class="single-product-content">
                    <h3 class="text-white">{{ $menu->name }}</h3>
                    <p class="single-product-pricing">Rp. {{ number_format($menu->price) }}</p>
                    {!! $menu->description !!}
                    <div class="single-product-form">
                        <a onclick="get_menu({{ $menu->id }})" class="cart-btn"><i class="fas fa-shopping-cart"></i> Add to Cart</a>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end single product -->

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
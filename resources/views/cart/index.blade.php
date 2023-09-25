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
                    <p>Fresh and Organic</p>
                    <h1>Cart</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb section -->

<!-- cart -->
<div class="cart-section mt-150 mb-150">
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if($msg = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <p class="text-black">{{ $msg }}</p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @elseif($msg = Session::get('danger'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <p class="text-black">{{ $msg }}</p>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @elseif ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        @foreach($errors->all() as $msg)
                            <p class="text-black">{{ $msg }}</p>
                        @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Belum di proses</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="proseskonfirmasi-tab" data-toggle="tab" data-target="#proseskonfirmasi" type="button" role="tab" aria-controls="proseskonfirmasi" aria-selected="false">Proses Konfirmasi</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="selesai-tab" data-toggle="tab" data-target="#selesai" type="button" role="tab" aria-controls="selesai" aria-selected="false">Selesai</button>
                    </li>
                </ul>
            </div>
            <div class="col-md-12 mt-3">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="row">
                            <div class="col-lg-8 col-md-12">
                                <div class="cart-table-wrap">
                                    <table class="cart-table">
                                        <thead class="cart-table-head">
                                            <tr class="table-head-row">
                                                <th class="product-remove"></th>
                                                <th>Order ID</th>
                                                <th class="product-image">Gambar</th>
                                                <th class="product-name">Nama</th>
                                                <th class="product-price">Harga</th>
                                                <th class="product-quantity">Jumlah</th>
                                                <th class="product-total">Total</th>
                                                <th class="product-subtotal">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $subtotal = array();
                                            @endphp
                                            @foreach ($cart as $key => $value)
                                                @php
                                                    $subtotal[$key] = $value->subtotal;
                                                @endphp
                                                <tr class="table-body-row">
                                                    <td class="product-remove"><a href="{{ route('cart.produk.delete', $value->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                                                    <td>{{ $value->order_id }}</td>
                                                    <td class="product-image"><img src="{{ url($value->menu_image) }}" alt=""></td>
                                                    <td class="product-name">{{ $value->menu }}</td>
                                                    <td class="product-price">Rp. {{ number_format($value->price) }}</td>
                                                    <td class="product-quantity">
                                                        {!! Form::open(['method' => 'post', 'route' => ['cart.updateQuantity', $value->id]]) !!}
                                                            @method('PUT')
                                                            <div class="number-input">
                                                                <button type="button" onclick="minus({{ $value->id }})"></button>
                                                                <input class="quantity" id="quantity{{ $value->id }}" min="0" name="quantity" type="number" value="0">
                                                                <button type="button" onclick="plus({{ $value->id }})" class="plus"></button>
                                                            </div><br>
                                                            <button type="submit" class="btn btn-primary btn-sm mt-3">Tambah</button>
                                                        {!! Form::close() !!}
                                                    </td>
                                                    <td class="product-total">{{ $value->quantity }}</td>
                                                    <td class="product-subtotal">Rp. {{ number_format($value->subtotal) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                
                            <div class="col-lg-4 col-sm-12">
                                <div class="total-section">
                                    <table class="total-table">
                                        <thead class="total-table-head">
                                            <tr class="table-total-row">
                                                <th>Total</th>
                                                <th>Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="total-data">
                                                <td><strong>Total: </strong></td>
                                                <td>Rp. {{ number_format(array_sum($subtotal)) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="cart-buttons">
                                        <a href="{{ route('home') }}" class="boxed-btn">Tambah Keranjang</a>
                                        <a href="{{ route('cart.checkout') }}" class="boxed-btn black">Check Out</a>
                                    </div>
                                </div>                
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="proseskonfirmasi" role="tabpanel" aria-labelledby="proseskonfirmasi-tab">
                        <div class="row">
                            <div class="col-lg-8 col-md-12">
                                <div class="cart-table-wrap">
                                    <table class="cart-table">
                                        <thead class="cart-table-head">
                                            <tr class="table-head-row">
                                                <th>Order ID</th>
                                                <th class="product-image">Gambar</th>
                                                <th class="product-name">Nama</th>
                                                <th class="product-price">Harga</th>
                                                <th class="product-quantity">Jumlah</th>
                                                <th class="product-subtotal">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $subtotal_konfirmasi = array();
                                            @endphp
                                            @foreach ($cart_menunggu_konfirmasi as $key => $value)
                                                @php
                                                    $subtotal_konfirmasi[$key] = $value->subtotal;
                                                @endphp
                                                <tr class="table-body-row">
                                                    <td>{{ $value->order_id }}</td>
                                                    <td class="product-image"><img src="{{ url($value->menu_image) }}" alt=""></td>
                                                    <td class="product-name">{{ $value->menu }}</td>
                                                    <td class="product-price">Rp. {{ number_format($value->price) }}</td>                                                    
                                                    <td class="product-total">{{ $value->quantity }}</td>
                                                    <td class="product-subtotal">Rp. {{ number_format($value->subtotal) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                
                            <div class="col-lg-4 col-sm-12">
                                <div class="total-section">
                                    <table class="total-table">
                                        <thead class="total-table-head">
                                            <tr class="table-total-row">
                                                <th>Total</th>
                                                <th>Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="total-data">
                                                <td><strong>Total: </strong></td>
                                                <td>Rp. {{ number_format(array_sum($subtotal_konfirmasi)) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>                                    
                                </div>                
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="selesai" role="tabpanel" aria-labelledby="selesai-tab">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="cart-table-wrap">
                                    <table class="cart-table">
                                        <thead class="cart-table-head">
                                            <tr class="table-head-row">
                                                <th class="product-image">Order ID</th>
                                                <th class="product-name">Meja</th>
                                                <th class="product-price">Total</th>
                                                <th class="product-quantity">Status</th>
                                                <th class="product-subtotal">Metode</th>
                                                <th class="product-subtotal">Nama Rekening</th>
                                                <th class="product-subtotal">Bank</th>
                                                <th class="product-subtotal">Pembayaran</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cart_selesai as $key => $value)
                                                <tr class="table-body-row">
                                                    <td class="product-image">{{ $value->id_order }}</td>
                                                    <td class="product-name">{{ $value->meja }}</td>
                                                    <td class="product-price">Rp. {{ number_format($value->total) }}</td>                                                    
                                                    <td class="product-total">
                                                        @if($value->status=='1')
                                                            <span class="badge bg-primary">Selesai</span>                                                            
                                                        @endif    
                                                    </td>
                                                    <td class="product-subtotal">
                                                        @if($value->metode=='1')
                                                            <i>Transfer</i>
                                                        @else
                                                            <i>Kasir</i>
                                                        @endif    
                                                    </td>
                                                    <td>{{ $value->name_rekening }}</td>
                                                    <td>{{ $value->bank }}</td>
                                                    <td>
                                                        @if($value->konfirmasi_pembayaran=='1')
                                                            <span class="badge bg-primary">Sudah dibayar</span>
                                                        @endif    
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
            
            
            
        </div>
    </div>
</div>
<!-- end cart -->

@endsection

@section('script')
    <script>
        function plus(id) {
            console.log(id);
            let number = document.querySelector('[id="quantity'+id+'"]');
            let numberplus = number.value = parseInt(number.value) + 1;
        }

        function minus(id) {
            let number = document.querySelector('[id="quantity'+id+'"]');
                if (parseInt(number.value) > 0) {
                let numberminus = number.value = parseInt(number.value) - 1;
            }
        }
    </script>
@endsection
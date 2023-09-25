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

<!-- check out section -->
<div class="checkout-section mt-150 mb-150">
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
            </div>     

            <div class="col-lg-8 col-sm-12">
                <div class="order-details-wrap">
                    <table class="order-details" style="width: 100%;">
                        <thead>
                            <tr class="text-center">
                                <th>Pesanan Anda</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody class="order-details-body">
                            <tr class="text-center">
                                <td>Menu</td>
                                <td>Jumlah</td>
                                <td>Harga</td>
                            </tr>
                            @php
                                $total = array();
                                $orderID = '';
                            @endphp
                            @foreach ($cart as $key => $value)
                                @php
                                    $orderID = $value->order_id;
                                    $total[$key] = $value->subtotal;
                                @endphp
                                <tr>
                                    <td>{{ $value->menu }}</td>
                                    <td class="text-center">{{ $value->quantity }}</td>
                                    <td class="text-center">Rp. {{ number_format($value->subtotal) }}</td>
                                </tr>
                            @endforeach                            
                        </tbody>
                        <tbody class="checkout-details">                            
                            <tr>
                                <td class="text-center">Total</td>
                                <td></td>
                                <td class="text-center">Rp. {{ number_format(array_sum($total)) }}</td>
                            </tr>
                        </tbody>
                    </table>                    
                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="checkout-accordion-wrap mt-3">
                    <div class="accordion" id="accordionExample">
                    {!! Form::open(['method' => 'post', 'route' => ['cart.payment'], 'enctype' => 'multipart/form-data']) !!}

                      <div class="card single-accordion">
                        <div class="card-header" id="headingOne">
                          <h5 class="mb-0">
                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              Metode Pembayaran
                            </button>
                          </h5>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                          <div class="card-body">

                            <input type="hidden" name="id_order" value="{{ $orderID }}">
                            <input type="hidden" name="total" value="{{ array_sum($total) }}">
                            
                            <div class="form-group">
                                <h6 class="font-bold text-black">
                                    <input type="radio" name="metode" id="hide" value="0"> 
                                    Kasir
                                </h6>
                            </div>
                            <div class="form-group">
                                <h6 class="font-bold text-black">
                                    <input type="radio" name="metode" id="show" value="1"> 
                                    Transfer
                                </h6>
                            </div>
                            <div class="box" id="box">
                                <div class="form-group" id="bankList">
                                    @foreach ($rekening as $value)                                
                                        <h6 class="font-bold text-black">
                                            <input type="radio" name="rekening_id" value="{{ $value->id }}">
                                            {{ $value->name_rekening }}
                                            <img src="{{ url($value->logo) }}" width="50">
                                            ({{ $value->no_rekening }})
                                        </h6>
                                    @endforeach
                                </div>
                                <div class="form-group" id="bukti">
                                    <h6 class="font-bold text-black">Bukti Pembayaran</h6>
                                    <input type="file" name="bukti_pembayaran" class="form-control">
                                </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <button type="submit" class="boxed-btn">Proses Order</button>

                    {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!-- end check out section -->

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            const box = document.getElementById('box');
            box.style.display = 'none';

            function handleRadioClick() {
                if (document.getElementById('show').checked) {
                    box.style.display = 'block';
                } else {
                    box.style.display = 'none';
                }
            }

            const radioButtons = document.querySelectorAll('input[name="metode"]');
                radioButtons.forEach(radio => {
                radio.addEventListener('click', handleRadioClick);
            });

        })
    </script>
@endsection
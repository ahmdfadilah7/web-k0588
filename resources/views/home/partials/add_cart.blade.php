<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="addcartModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah ke Keranjang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(['method' => 'post', 'route' => ['cart.prosesTambah']]) }}
                <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="form-label">Nama</label>
                                @if($orderCheck == 0)
                                    <input type="text" name="name_customer" class="form-control">
                                @else
                                    <input type="text" name="name_customer" class="form-control" value="{{ $order->name_customer }}" readonly>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Menu</label>
                                <input type="hidden" name="menu_id" id="menuId" class="form-control">
                                <input type="text" name="menu_name" id="menuName" readonly class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Harga (Rp)</label>
                                <input type="text" name="price" id="menuPrice" readonly class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="" class="form-label">Jumlah</label><br>
                                <div class="number-input">
                                    <button type="button" onclick="minus()" class="black"></button>
                                    <input class="quantity" id="quantity" min="0" name="quantity" type="number" value="0">
                                    <button type="button" onclick="plus()" class="plus black"></button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="" class="form-label">Total (Rp)</label>
                                <input type="number" name="total_price" id="totalPrice" class="form-control" readonly>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Tambah</button>
                {{ Form::close() }}
                <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>

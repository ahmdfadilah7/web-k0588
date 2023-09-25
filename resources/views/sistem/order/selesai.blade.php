@extends('sistem.layouts.app')
@include('sistem.layouts.partials.css')
@include('sistem.layouts.partials.js')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Order Payment</h5>
            @if($msg = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <p>{{ $msg }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif ($msg = Session::get('danger'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <p>{{ $msg }}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="table-responsive mt-4">
                <table id="example1" class="table table-bordered hover stripe text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Meja</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Metode</th>
                            <th>Name Rekening</th>
                            <th>No Rekening</th>
                            <th>Bank</th>
                            <th>Bukti</th>
                            <th>Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(function() {
            var table = $('#example1').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                "ordering": 'true',
                ajax: {
                    url: "{{ route('sistem.order.listselesai') }}",
                    data: function(d) {}
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'id_order',
                        name: 'id_order'
                    },
                    {
                        data: 'meja',
                        name: 'mejas.name'
                    },

                    {
                        data: 'total',
                        name: 'total'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'metode',
                        name: 'metode'
                    },
                    {
                        data: 'name_rekening',
                        name: 'name_rekening'
                    },
                    {
                        data: 'no_rekening',
                        name: 'no_rekening'
                    },
                    {
                        data: 'bank',
                        name: 'bank'
                    },
                    {
                        data: 'bukti_pembayaran',
                        name: 'bukti_pembayaran'
                    },
                    {
                        data: 'konfirmasi_pembayaran',
                        name: 'konfirmasi_pembayaran'
                    }
                ]
            });
        });
    </script>

@endsection
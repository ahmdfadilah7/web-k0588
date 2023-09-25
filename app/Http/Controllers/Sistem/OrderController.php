<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    // Menampilkan halaman order
    public function index()
    {
        $setting = Setting::first();

        return view('sistem.order.index', compact('setting'));
    }

    // proses menampilkan data dengan datatables
    public function listData()
    {
        $data = Order::join('mejas', 'orders.meja_id', 'mejas.id')
            ->where('status', '0')
            ->select('orders.*', 'mejas.name as meja');
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function($row) {
                if ($row->status==0) {
                    $status = '<span class="badge bg-warning">Keranjang</span>';
                } elseif ($row->status==1) {
                    $status = '<span class="badge bg-primary">Proses Payment</span>';
                } else {
                    $status = '<span class="badge bg-danger">Dibatalkan</span>';
                }
                return $status;
            })
            ->addColumn('metode', function($row) {
                if ($row->metode==0) {
                    $metode = '<i>Kasir</i>';
                } else {
                    $metode = '<i>Transfer</i>';
                }
                return $metode;
            })
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('sistem.order.edit', $row->id).'" class="btn btn-primary btn-sm" style="margin-right:10px;">
                            <i class="ti ti-edit"></i>
                        </a>';
                $btn .= '<a href="'.route('sistem.order.delete', $row->id).'" class="btn btn-danger btn-sm">
                        <i class="ti ti-trash"></i>
                    </a>';
                return $btn;
            })
            ->rawColumns(['action', 'status', 'metode'])
            ->make(true);
        
        return $datatables;
    }

    // Menampilkan halaman order
    public function payment()
    {
        $setting = Setting::first();

        return view('sistem.order.payment', compact('setting'));
    }

    // proses menampilkan data dengan datatables
    public function listDataPayment()
    {
        $data = Order::join('mejas', 'orders.meja_id', 'mejas.id')
            ->where('status', '1')
            ->where('konfirmasi_pembayaran', '0')
            ->select('orders.*', 'mejas.name as meja');
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('total', function($row) {
                $total = 'Rp. '.number_format($row->total);
                return $total;
            })
            ->addColumn('bukti_pembayaran', function($row) {
                if ($row->bukti_pembayaran <> '' || $row->bukti_pembayaran <> null) {
                    $bukti = '<a href="'.url($row->bukti_pembayaran).'" target="_blank">
                                <img src="'.url($row->bukti_pembayaran).'" width="50">
                            </a>';
                } else {
                    $bukti = '';
                }
                return $bukti;
            })
            ->addColumn('status', function($row) {
                if ($row->status==0) {
                    $status = '<span class="badge bg-warning">Keranjang</span>';
                } elseif ($row->status==1) {
                    $status = '<span class="badge bg-primary">Proses Payment</span>';
                } else {
                    $status = '<span class="badge bg-danger">Dibatalkan</span>';
                }
                return $status;
            })
            ->addColumn('metode', function($row) {
                if ($row->metode==0) {
                    $metode = '<i>Kasir</i>';
                } else {
                    $metode = '<i>Transfer</i>';
                }
                return $metode;
            })
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('sistem.order.konfirmasi', $row->id_order).'" class="btn btn-primary btn-sm" title="konfirmasi" style="margin-right:10px;">
                            <i class="ti ti-check"></i>
                        </a>';
                return $btn;
            })
            ->rawColumns(['action', 'status', 'metode', 'total', 'bukti_pembayaran'])
            ->make(true);
        
        return $datatables;
    }

    // Menampilkan halaman order
    public function selesai()
    {
        $setting = Setting::first();

        return view('sistem.order.selesai', compact('setting'));
    }

    // proses menampilkan data dengan datatables
    public function listDataSelesai()
    {
        $data = Order::join('mejas', 'orders.meja_id', 'mejas.id')
            ->where('status', '1')
            ->where('konfirmasi_pembayaran', '1')
            ->select('orders.*', 'mejas.name as meja');
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('total', function($row) {
                $total = 'Rp. '.number_format($row->total);
                return $total;
            })
            ->addColumn('status', function($row) {
                if ($row->status==0) {
                    $status = '<span class="badge bg-warning">Keranjang</span>';
                } elseif ($row->status==1) {
                    $status = '<span class="badge bg-primary">Selesai</span>';
                } else {
                    $status = '<span class="badge bg-danger">Dibatalkan</span>';
                }
                return $status;
            })
            ->addColumn('metode', function($row) {
                if ($row->metode==0) {
                    $metode = '<i>Kasir</i>';
                } else {
                    $metode = '<i>Transfer</i>';
                }
                return $metode;
            })
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('sistem.order.konfirmasi', $row->id_order).'" class="btn btn-primary btn-sm" title="konfirmasi" style="margin-right:10px;">
                            <i class="ti ti-check"></i>
                        </a>';
                return $btn;
            })
            ->addColumn('konfirmasi_pembayaran', function($row) {
                $konfirmasi = '<span class="badge bg-primary">Sudah dibayar</span>';
                return $konfirmasi;
            })
            ->addColumn('bukti_pembayaran', function($row) {
                if ($row->bukti_pembayaran <> '' || $row->bukti_pembayaran <> null) {
                    $bukti = '<a href="'.url($row->bukti_pembayaran).'" target="_blank">
                                <img src="'.url($row->bukti_pembayaran).'" width="50">
                            </a>';
                } else {
                    $bukti = '';
                }
                return $bukti;
            })
            ->rawColumns(['action', 'status', 'metode', 'total', 'konfirmasi_pembayaran', 'bukti_pembayaran'])
            ->make(true);
        
        return $datatables;
    }

    // Konfirmasi order
    public function konfirmasi($orderId)
    {
        $order = Order::where('id_order', $orderId)->first();
        $order->konfirmasi_pembayaran = '1';
        $order->save();

        return redirect()->route('sistem.order.payment')->with('success', 'Berhasil mengkonfirmasi order.');
    }
}

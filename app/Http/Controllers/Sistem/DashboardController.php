<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Menampilkan halaman dashboard
    public function index()
    {
        $setting = Setting::first();
        $order = Order::whereMonth('created_at', date('m'))->get();
        $order_keranjang = Order::where('status', '0')->whereMonth('created_at', date('m'));
        $order_pembayaran = Order::where('status', '1')->where('konfirmasi_pembayaran', '0')->whereMonth('created_at', date('m'));
        $order_selesai = Order::where('status', '1')->where('konfirmasi_pembayaran', '1')->whereMonth('created_at', date('m'));

        return view('sistem.dashboard.index', compact('setting', 'order', 'order_keranjang', 'order_pembayaran', 'order_selesai'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Rekening;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CartController extends Controller
{
    // Menampilkan halaman keranjang
    public function index()
    {
        $setting = Setting::first();
        $cart = Order::join('carts', 'orders.id_order', 'carts.order_id')
            ->join('menus', 'carts.menu_id', 'menus.id')
            ->where('orders.meja_id', Auth::guard('webmeja')->user()->id)
            ->where('status', '0')
            ->select('menus.name as menu', 'menus.image as menu_image', 'carts.*')
            ->get();
        $cart_menunggu_konfirmasi = Order::join('carts', 'orders.id_order', 'carts.order_id')
            ->join('menus', 'carts.menu_id', 'menus.id')
            ->where('orders.meja_id', Auth::guard('webmeja')->user()->id)
            ->where('status', '1')
            ->where('konfirmasi_pembayaran', '0')
            ->select('menus.name as menu', 'menus.image as menu_image', 'carts.*')
            ->get();
        $cart_selesai = Order::join('mejas', 'orders.meja_id', 'mejas.id')
            ->where('status', '1')
            ->where('konfirmasi_pembayaran', '1')
            ->where('orders.meja_id', Auth::guard('webmeja')->user()->id)
            ->select('orders.*', 'mejas.name as meja')
            ->get();
        $cartNum = Order::join('carts', 'orders.id_order', 'carts.order_id')
            ->join('menus', 'carts.menu_id', 'menus.id')
            ->where('orders.meja_id', Auth::guard('webmeja')->user()->id)
            ->where('status', '0')
            ->select('menus.name as menu', 'menus.image as menu_image', 'carts.*')
            ->count();

        return view('cart.index', compact('setting', 'cart', 'cartNum', 'cart_menunggu_konfirmasi', 'cart_selesai'));
    }

    // Proses checkout 
    public function checkout()
    {
        $setting =Setting::first();
        $cart = Order::join('carts', 'orders.id_order', 'carts.order_id')
            ->join('menus', 'carts.menu_id', 'menus.id')
            ->where('orders.meja_id', Auth::guard('webmeja')->user()->id)
            ->where('status', '0')
            ->select('menus.name as menu', 'menus.image as menu_image', 'carts.*')
            ->get();
        $cartNum = Order::join('carts', 'orders.id_order', 'carts.order_id')
            ->join('menus', 'carts.menu_id', 'menus.id')
            ->where('orders.meja_id', Auth::guard('webmeja')->user()->id)
            ->where('status', '0')
            ->select('menus.name as menu', 'menus.image as menu_image', 'carts.*')
            ->count();
        $rekening = Rekening::join('banks', 'rekenings.bank_id', 'banks.id')
            ->select('rekenings.*', 'banks.logo')
            ->get();

        return view('cart.checkout', compact('setting', 'cart', 'cartNum', 'rekening'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_customer' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'total_price' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        $setting = Setting::first();
        $menu = Menu::find($request->get('menu_id'));
        
        $orderID = Order::where('meja_id', Auth::guard('webmeja')->user()->id)
                ->where('status', '0');
        if ($orderID->count() > 0) {
            $cart = Cart::where('meja_id', Auth::guard('webmeja')->user()->id)
                ->where('order_id', $orderID->first()->id_order)
                ->where('menu_id', $request->get('menu_id'));
            if ($cart->count() > 0) {
                $cartupdate = Cart::find($cart->first()->id);
                $cartupdate->quantity = $cart->first()->quantity + $request->get('quantity');
                $cartupdate->subtotal = ($cart->first()->quantity + $request->get('quantity')) * $request->get('price');
                $cartupdate->save();
            } else {
                Cart::create([
                    'order_id' => $orderID->first()->id_order,
                    'meja_id' => Auth::guard('webmeja')->user()->id,
                    'menu_id' => $request->get('menu_id'),
                    'name_customer' => $request->get('name_customer'),
                    'quantity' => $request->get('quantity'),
                    'price' => $request->get('price'),
                    'subtotal' => $request->get('total_price')
                ]);
            }

            return redirect()->route('home')->with('success', 'Berhasil menambahkan ke keranjang.');

        } else {
            $id_order = 'ORD'.strtoupper(str_replace(' ', '', $setting->name_website)).'-'.Str::random(5);
            Order::create([
                'id_order' => $id_order,
                'meja_id' => Auth::guard('webmeja')->user()->id,
                'status' => '0'
            ]);

            Cart::create([
                'order_id' => $id_order,
                'meja_id' => Auth::guard('webmeja')->user()->id,
                'menu_id' => $request->get('menu_id'),
                'name_customer' => $request->get('name_customer'),
                'quantity' => $request->get('quantity'),
                'price' => $request->get('price'),
                'subtotal' => $request->get('total_price')
            ]);

            return redirect()->route('home')->with('success', 'Berhasil menambahkan ke keranjang.');
        }
    }

    // Proses pembayaran
    public function proses_payment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'metode' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        if($request->get('metode')==0) {
            $order = Order::where('id_order', $request->get('id_order'))->first();
            $order->status = '1';            
            $order->metode = $request->get('metode');    
            $order->konfirmasi_pembayaran = '0';    
            $order->total = $request->get('total');
            $order->save();    
        
            return redirect()->route('cart')->with('success', 'Pesanan anda sedang diproses.');
        } elseif ($request->get('metode')==1) {
            $validator = Validator::make($request->all(), [
                'rekening_id' => 'required',
                'bukti_pembayaran' => 'required',
            ]);

            if ($validator->fails()) {
                $errors = $validator->errors();
                return back()->with('errors', $errors);
            }

            $rekening = Rekening::join('banks', 'rekenings.bank_id', 'banks.id')
                ->where('rekenings.id', $request->get('rekening_id'))
                ->select('rekenings.*', 'banks.name_bank')
                ->first();

            $bukti = $request->file('bukti_pembayaran');
            $namebukti = 'Bukti-Pembayaran-'.$request->get('id_order').'.'.$bukti->extension();
            $tujuan = 'images';
            $bukti->move(public_path($tujuan), $namebukti);
            $buktiName = $tujuan.'/'.$namebukti;

            $order = Order::where('id_order', $request->get('id_order'))->first();
            $order->status = '1';
            $order->total = $request->get('total');
            $order->metode = $request->get('metode');
            $order->name_rekening = $rekening->name_rekening;
            $order->no_rekening = $rekening->no_rekening;
            $order->bank = $rekening->name_bank;
            $order->bukti_pembayaran = $buktiName;
            $order->konfirmasi_pembayaran = '0';
            $order->save();

            return redirect()->route('cart')->with('success', 'Pesanan anda sedang diproses');
        }
    }

    public function update_quantity(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors);
        }

        if ($request->get('quantity') > 0) {
            $cart = Cart::find($id);
            $cart->quantity = $cart->quantity + $request->get('quantity');
            $cart->subtotal = $cart->quantity * $cart->price;
            $subtotal = ($cart->quantity + $request->get('quantity')) * $cart->price;
            $cart->save();

            return redirect()->route('cart')->with('success', 'Berhasil menambahkan jumlah.');
        } else {
            return redirect()->route('cart')->with('danger', 'Jumlah tidak boleh kosong.');
        }
    }    

    public function delete_produk($id)
    {
        $cart = Cart::find($id);
        $cart->delete();

        return redirect()->route('cart')->with('success', 'Berhasil menghapus produk dari keranjang.');
    }
}

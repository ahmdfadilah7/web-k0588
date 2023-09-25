<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\KategoriMenu;
use App\Models\Menu;
use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    // Menampilkan Halaman Home
    public function index()
    {
        $setting = Setting::first();
        $kategorimenu = KategoriMenu::get();
        $menu = Menu::join('kategori_menus', 'menus.kategorimenu_id', 'kategori_menus.id')
                ->select('menus.*', 'kategori_menus.title as kategorimenu')
                ->paginate(9);
        if (Str::length(Auth::guard('webmeja')->user()) > 0) {
            $orderRow = Order::join('carts', 'orders.id_order', 'carts.order_id')
                ->where('orders.meja_id', Auth::guard('webmeja')->user()->id)
                ->where('orders.status', '0')
                ->select('carts.name_customer', 'orders.id_order');
            if ($orderRow->count() > 0) {
                $orderCheck = 1;
                $order = $orderRow->first();
                $cartNum = Cart::where('order_id', $orderRow->first()->id_order)->count();
            } else {
                $orderCheck = 0;
                $order = '';
                $cartNum = 0;
            }
        } else {
            $orderCheck = 0;
            $order = '';
            $cartNum = 0;
        }
        return view('home.index', compact('setting', 'kategorimenu', 'menu', 'order', 'orderCheck', 'cartNum'));
    }

    // Form search
    public function search(Request $request)
    {
        $setting = Setting::first();
        $kategorimenu = KategoriMenu::get();
        $menu = Menu::join('kategori_menus', 'menus.kategorimenu_id', 'kategori_menus.id')
                ->where('menus.name', 'LIKE', '%'.$request->get('key').'%')
                ->select('menus.*', 'kategori_menus.title as kategorimenu')
                ->get();
        if (Str::length(Auth::guard('webmeja')->user()) > 0) {
            $orderRow = Order::join('carts', 'orders.id_order', 'carts.order_id')
                ->where('orders.meja_id', Auth::guard('webmeja')->user()->id)
                ->where('orders.status', '0')
                ->select('carts.name_customer', 'orders.id_order');
            if ($orderRow->count() > 0) {
                $orderCheck = 1;
                $order = $orderRow->first();
                $cartNum = Cart::where('order_id', $orderRow->first()->id_order)->count();
            } else {
                $orderCheck = 0;
                $order = '';
                $cartNum = 0;
            }
        } else {
            $orderCheck = 0;
            $order = '';
            $cartNum = 0;
        }
        return view('home.index', compact('setting', 'kategorimenu', 'menu', 'order', 'orderCheck', 'cartNum'));
    }

    public function detail($id, $slug)
    {
        $slug = str_replace('-', ' ', $slug);
        $setting = Setting::first();
        $kategorimenu = KategoriMenu::get();
        $menu = Menu::join('kategori_menus', 'menus.kategorimenu_id', 'kategori_menus.id')
                ->where('menus.name', 'LIKE', '%'.$slug.'%')
                ->select('menus.*', 'kategori_menus.title as kategorimenu')
                ->find($id);
        if (Str::length(Auth::guard('webmeja')->user()) > 0) {
            $orderRow = Order::join('carts', 'orders.id_order', 'carts.order_id')
                ->where('orders.meja_id', Auth::guard('webmeja')->user()->id)
                ->where('orders.status', '0')
                ->select('carts.name_customer', 'orders.id_order');
            if ($orderRow->count() > 0) {
                $orderCheck = 1;
                $order = $orderRow->first();
                $cartNum = Cart::where('order_id', $orderRow->first()->id_order)->count();
            } else {
                $orderCheck = 0;
                $order = '';
                $cartNum = 0;
            }
        } else {
            $orderCheck = 0;
            $order = '';
            $cartNum = 0;
        }
        return view('home.detail', compact('setting', 'kategorimenu', 'menu', 'order', 'orderCheck', 'cartNum'));
    }

    public function getMenu($id)
    {
        $menu = Menu::find($id);
        $name = $menu->name;

        return json_encode($menu);
    }
}

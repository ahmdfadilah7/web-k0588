<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Sistem\AuthController;
use App\Http\Controllers\Sistem\BankController;
use App\Http\Controllers\Sistem\DashboardController;
use App\Http\Controllers\Sistem\KategoriMenuController;
use App\Http\Controllers\Sistem\MejaController;
use App\Http\Controllers\Sistem\MenuController;
use App\Http\Controllers\Sistem\OrderController;
use App\Http\Controllers\Sistem\RekeningController;
use App\Http\Controllers\Sistem\SettingController;
use App\Http\Controllers\Sistem\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('login_qrcode/{table}',[LoginController::class, 'login'])->name('login_qrcode');
Route::post('proses_login_qrcode',[LoginController::class, 'proses_login'])->name('proses_login_qrcode');
Route::get('logout',[LoginController::class, 'logout'])->name('logout');

Route::get('sistem', [AuthController::class, 'login'])->name('sistem.login');
Route::get('sistem/login', [AuthController::class, 'login'])->name('sistem.login');
Route::post('sistem/prosesLogin', [AuthController::class, 'proses_login'])->name('sistem.proseslogin');
Route::get('sistem/registerAdm', [AuthController::class, 'register'])->name('sistem.registerAdm');
Route::post('sistem/proses_registerAdm', [AuthController::class, 'proses_register'])->name('sistem.prosesregisterAdm');
Route::get('sistem/logout', [AuthController::class, 'logout'])->name('sistem.logout');

// Search
Route::get('search', [HomeController::class, 'search'])->name('search');

Route::get('menu/detail/{id}/{slug}', [HomeController::class, 'detail'])->name('menu.detail');

Route::group(['middleware' => ['auth:webmeja']], function() {

    // Menu
    Route::get('get_menu/{id}', [HomeController::class, 'getMenu'])->name('get_menu');

    // Cart
    Route::get('cart', [CartController::class, 'index'])->name('cart');
    Route::get('cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('cart/proses_tambah', [CartController::class, 'store'])->name('cart.prosesTambah');
    Route::put('cart/updatequantity/{id}', [CartController::class, 'update_quantity'])->name('cart.updateQuantity');
    Route::get('cart/produkdelete/{id}', [CartController::class, 'delete_produk'])->name('cart.produk.delete');
    Route::post('cart/payment', [CartController::class, 'proses_payment'])->name('cart.payment');

});

Route::group(['middleware' => ['auth:websistem']], function() {

    // Dashboard
    Route::get('sistem/dashboard', [DashboardController::class, 'index'])->name('sistem.dashboard');
    
    // Setting
    Route::get('sistem/setting', [SettingController::class, 'index'])->name('sistem.setting');
    Route::get('sistem/setting/getListData', [SettingController::class, 'listData'])->name('sistem.setting.list');
    Route::get('sistem/setting/add', [SettingController::class, 'create'])->name('sistem.setting.add');
    Route::post('sistem/setting/store', [SettingController::class, 'store'])->name('sistem.setting.store');
    Route::get('sistem/setting/edit/{id}', [SettingController::class, 'edit'])->name('sistem.setting.edit');
    Route::put('sistem/setting/update/{id}', [SettingController::class, 'update'])->name('sistem.setting.update');

    // Order
    Route::get('sistem/order', [OrderController::class, 'index'])->name('sistem.order');
    Route::get('sistem/order/payment', [OrderController::class, 'payment'])->name('sistem.order.payment');
    Route::get('sistem/order/selesai', [OrderController::class, 'selesai'])->name('sistem.order.selesai');
    Route::get('sistem/order/getListData', [OrderController::class, 'listData'])->name('sistem.order.list');
    Route::get('sistem/order/getListDataPayment', [OrderController::class, 'listDataPayment'])->name('sistem.order.listpayment');
    Route::get('sistem/order/getListDataSelesai', [OrderController::class, 'listDataSelesai'])->name('sistem.order.listselesai');
    Route::get('sistem/order/konfirmasi/{id}', [OrderController::class, 'konfirmasi'])->name('sistem.order.konfirmasi');
    Route::get('sistem/order/add', [OrderController::class, 'create'])->name('sistem.order.add');
    Route::post('sistem/order/store', [OrderController::class, 'store'])->name('sistem.order.store');
    Route::get('sistem/order/edit/{id}', [OrderController::class, 'edit'])->name('sistem.order.edit');
    Route::put('sistem/order/update/{id}', [OrderController::class, 'update'])->name('sistem.order.update');
    Route::get('sistem/order/delete/{id}', [OrderController::class, 'destroy'])->name('sistem.order.delete');
    
    // Meja
    Route::get('sistem/meja', [MejaController::class, 'index'])->name('sistem.meja');
    Route::get('sistem/meja/getListData', [MejaController::class, 'listData'])->name('sistem.meja.list');
    Route::get('sistem/meja/add', [MejaController::class, 'create'])->name('sistem.meja.add');
    Route::post('sistem/meja/store', [MejaController::class, 'store'])->name('sistem.meja.store');
    Route::get('sistem/meja/edit/{id}', [MejaController::class, 'edit'])->name('sistem.meja.edit');
    Route::put('sistem/meja/update/{id}', [MejaController::class, 'update'])->name('sistem.meja.update');
    Route::get('sistem/meja/delete/{id}', [MejaController::class, 'destroy'])->name('sistem.meja.delete');

    // Kategori Menu
    Route::get('sistem/kategorimenu', [KategoriMenuController::class, 'index'])->name('sistem.kategorimenu');
    Route::get('sistem/kategorimenu/getListData', [KategoriMenuController::class, 'listData'])->name('sistem.kategorimenu.list');
    Route::get('sistem/kategorimenu/add', [KategoriMenuController::class, 'create'])->name('sistem.kategorimenu.add');
    Route::post('sistem/kategorimenu/store', [KategoriMenuController::class, 'store'])->name('sistem.kategorimenu.store');
    Route::get('sistem/kategorimenu/edit/{id}', [KategoriMenuController::class, 'edit'])->name('sistem.kategorimenu.edit');
    Route::put('sistem/kategorimenu/update/{id}', [KategoriMenuController::class, 'update'])->name('sistem.kategorimenu.update');
    Route::get('sistem/kategorimenu/delete/{id}', [KategoriMenuController::class, 'destroy'])->name('sistem.kategorimenu.delete');

    // Menu
    Route::get('sistem/menu', [MenuController::class, 'index'])->name('sistem.menu');
    Route::get('sistem/menu/getListData', [MenuController::class, 'listData'])->name('sistem.menu.list');
    Route::get('sistem/menu/add', [MenuController::class, 'create'])->name('sistem.menu.add');
    Route::post('sistem/menu/store', [MenuController::class, 'store'])->name('sistem.menu.store');
    Route::get('sistem/menu/edit/{id}', [MenuController::class, 'edit'])->name('sistem.menu.edit');
    Route::put('sistem/menu/update/{id}', [MenuController::class, 'update'])->name('sistem.menu.update');
    Route::get('sistem/menu/delete/{id}', [MenuController::class, 'destroy'])->name('sistem.menu.delete');

    // Bank
    Route::get('sistem/bank', [BankController::class, 'index'])->name('sistem.bank');
    Route::get('sistem/bank/getListData', [BankController::class, 'listData'])->name('sistem.bank.list');
    Route::get('sistem/bank/add', [BankController::class, 'create'])->name('sistem.bank.add');
    Route::post('sistem/bank/store', [BankController::class, 'store'])->name('sistem.bank.store');
    Route::get('sistem/bank/edit/{id}', [BankController::class, 'edit'])->name('sistem.bank.edit');
    Route::put('sistem/bank/update/{id}', [BankController::class, 'update'])->name('sistem.bank.update');
    Route::get('sistem/bank/delete/{id}', [BankController::class, 'destroy'])->name('sistem.bank.delete');

    // Rekening
    Route::get('sistem/rekening', [RekeningController::class, 'index'])->name('sistem.rekening');
    Route::get('sistem/rekening/getListData', [RekeningController::class, 'listData'])->name('sistem.rekening.list');
    Route::get('sistem/rekening/add', [RekeningController::class, 'create'])->name('sistem.rekening.add');
    Route::post('sistem/rekening/store', [RekeningController::class, 'store'])->name('sistem.rekening.store');
    Route::get('sistem/rekening/edit/{id}', [RekeningController::class, 'edit'])->name('sistem.rekening.edit');
    Route::put('sistem/rekening/update/{id}', [RekeningController::class, 'update'])->name('sistem.rekening.update');
    Route::get('sistem/rekening/delete/{id}', [RekeningController::class, 'destroy'])->name('sistem.rekening.delete');

    // User
    Route::get('sistem/user', [UserController::class, 'index'])->name('sistem.user');
    Route::get('sistem/user/getListData', [UserController::class, 'listData'])->name('sistem.user.list');
    Route::get('sistem/user/add', [UserController::class, 'create'])->name('sistem.user.add');
    Route::post('sistem/user/store', [UserController::class, 'store'])->name('sistem.user.store');
    Route::get('sistem/user/edit/{id}', [UserController::class, 'edit'])->name('sistem.user.edit');
    Route::put('sistem/user/update/{id}', [UserController::class, 'update'])->name('sistem.user.update');
    Route::get('sistem/user/delete/{id}', [UserController::class, 'destroy'])->name('sistem.user.delete');

});
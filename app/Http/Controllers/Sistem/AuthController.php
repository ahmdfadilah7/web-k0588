<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function login()
    {
        $setting = Setting::first();
        return view('sistem.auth.login', compact('setting'));
    }

    // Menampilkan halaman register
    public function register()
    {
        $setting = Setting::first();
        return view('sistem.auth.register', compact('setting'));
    }

    // Proses Logout
    public function logout()
    {
        if (Auth::guard('websistem')->check()) {
            Auth::guard('websistem')->logout();
        }
        return redirect()->route('sistem.login')->with('success', 'Berhasil keluar.');
    }

    // Proses Login
    public function proses_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        $username = $request->get('username');
        $password = Hash::make($request->get('password'));
        if (Auth::guard('websistem')->attempt($request->only('username', 'password'))) {
            return redirect()->route('sistem.dashboard')->with('success', 'Berhasil login');
        } else {
            return back()->with('danger', 'Data yang dimasukkan tidak sesuai.');
        }

    }

    // Proses registrasi
    public function proses_register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'foto' => 'mimes:png,jpg,jpeg,svg,gif',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        if ($request->foto <> '') {
            $foto = $request->file('foto');
            $namafoto = 'Profile-'.str_replace(' ','-',$request->get('name')).'-'.Str::random(4).'.'.$foto->extension();
            $tujuan = 'images';
            $foto->move(public_path($tujuan), $namafoto);
            $fotonama = $tujuan.'/'.$namafoto;
        } else {
            $fotonama = '';
        }

        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'username' => $request->get('username'),
            'foto' => $fotonama,
            'role' => 'Administrator',
            'password' => Hash::make($request->get('password'))
        ]);

        return redirect()->route('sistem.login')->with('success', 'Berhasil melakukan pendaftaran.');
    }
}

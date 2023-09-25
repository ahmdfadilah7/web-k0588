<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login($table)
    {
        $setting = Setting::first();
        $meja = Meja::where('username', $table)->first();

        return view('auth.login', compact('setting', 'meja'));
    }

    public function proses_login(Request $request)
    {
        $username = $request->username;
        $password = Hash::make('123456');
        if (Auth::guard('webmeja')->attempt($request->only('username', 'password'))) {
            $result = 1;
        } else {
            $result = 0;
        }
        $data = [
            'result' => $result,
            'username' => $username,
            'password' => $password
        ];
        return $data;
    }

    public function logout()
    {
        if (Auth::guard('webmeja')->check()) {
            Auth::guard('webmeja')->logout();
        }

        return redirect()->route('home')->with('success', 'Berhasil keluar.');
    }
}

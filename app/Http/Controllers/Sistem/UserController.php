<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    // Menampilkan halaman user
    public function index()
    {
        $setting = Setting::first();

        return view('sistem.user.index', compact('setting'));
    }

    // proses menampilkan data dengan datatables
    public function listData()
    {
        if (Auth::guard('websistem')->user()->role == 'Administrator') {
            $data = User::query();
        } else {
            $data = User::where('id', Auth::guard('websistem')->user()->id);
        }
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('foto', function($row) {
                $foto = '<img src="'.url($row->foto).'" width="70">';
                return $foto;
            })
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('sistem.user.edit', $row->id).'" class="btn btn-primary btn-sm mr-2" style="margin-right:10px;">
                            <i class="ti ti-edit"></i>
                        </a>';
                if (Auth::guard('websistem')->user()->role=='Administrator') {
                    if ($row->id <> Auth::guard('websistem')->user()->id) {
                        $btn .= '<a href="'.route('sistem.user.delete', $row->id).'" class="btn btn-danger btn-sm mr-2">
                                    <i class="ti ti-trash"></i>
                                </a>';
                    }
                }
                return $btn;
            })
            ->rawColumns(['action', 'foto'])
            ->make(true);
        
        return $datatables;
    }

    // Menampilkan halaman tambah user
    public function create()
    {
        $setting = Setting::first();

        return view('sistem.user.add', compact('setting'));
    }

    // Proses menambahkan user
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'role' => 'required',
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
            'role' => $request->get('role'),
            'password' => Hash::make($request->get('password'))
        ]);

        return redirect()->route('sistem.user')->with('success', 'Berhasil menambahkan user.');
    }

    // Menampilkan halaman edit user
    public function edit($id)
    {
        $setting = Setting::first();
        $user = User::find($id);

        return view('sistem.user.edit', compact('setting', 'user'));
    }

    // Proses mengedit user
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'role' => 'required',
            'email' => 'required',
            'foto' => 'mimes:png,jpg,jpeg,svg,gif',
            'username' => 'required',
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

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->username = $request->get('username');
        if ($request->foto <> '' || $request->foto <> null) {
            $user->foto = $fotonama;
        }
        $user->role = $request->get('role');
        if ($request->get('password') <> '') {
            $user->password = Hash::make($request->get('password'));
        }
        $user->save();

        return redirect()->route('sistem.user')->with('success', 'Berhasil mengedit user.');
    }

    // Menghapus user
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        File::delete($user->foto);

        return redirect()->route('sistem.user')->with('success', 'Berhasil menghapus user.');
    }
}

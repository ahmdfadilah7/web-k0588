<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\KategoriMenu;
use App\Models\Menu;
use App\Models\Setting;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    // Menampilkan halaman menu
    public function index()
    {
        $setting = Setting::first();

        return view('sistem.menu.index', compact('setting'));
    }

    // proses menampilkan data dengan datatables
    public function listData()
    {
        $data = Menu::join('kategori_menus', 'menus.kategorimenu_id', 'kategori_menus.id')
            ->select('menus.*', 'kategori_menus.title as kategorimenu');
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('price', function($row) {
                $price = 'Rp. '.number_format($row->price);
                return $price;
            })
            ->addColumn('image', function($row) {
                $image = '<img src="'.url($row->image).'" width="70">';
                return $image;
            })
            ->addColumn('description', function($row) {
                $desc = Str::substr($row->description, 3, 50);
                return '<i>'.$desc.'...</i>';
            })
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('sistem.menu.edit', $row->id).'" class="btn btn-primary btn-sm" style="margin-right:10px;">
                            <i class="ti ti-edit"></i>
                        </a>';
                $btn .= '<a href="'.route('sistem.menu.delete', $row->id).'" class="btn btn-danger btn-sm">
                        <i class="ti ti-trash"></i>
                    </a>';
                return $btn;
            })
            ->rawColumns(['action', 'price', 'image', 'description'])
            ->make(true);
        
        return $datatables;
    }

    // Menampilkan halaman tambah menu
    public function create()
    {
        $setting = Setting::first();
        $kategorimenu = KategoriMenu::get();

        return view('sistem.menu.add', compact('setting', 'kategorimenu'));
    }

    // Proses menambahkan menu
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'kategorimenu_id' => 'required',
            'price' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,svg,webp',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        $image = $request->file('image');
        $namaimage = 'Menu-'.strtolower(str_replace(' ', '-', $request->get('name'))).'-'.Str::random(5).'.'.$image->extension();
        $tujuan = 'images';
        $image->move(public_path($tujuan), $namaimage);
        $imageName = $tujuan.'/'.$namaimage;

        Menu::create([
            'name' => $request->get('name'),
            'kategorimenu_id' => $request->get('kategorimenu_id'),
            'price' => $request->get('price'),
            'image' => $imageName,
            'description' => $request->get('description')
        ]);

        return redirect()->route('sistem.menu')->with('success', 'Berhasil menambahkan menu.');
    }

    // Menampilkan halaman edit menu
    public function edit($id)
    {
        $setting = Setting::first();
        $menu = Menu::find($id);
        $kategorimenu = KategoriMenu::get();

        return view('sistem.menu.edit', compact('setting', 'menu', 'kategorimenu'));
    }

    // Proses mengupdate menu
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'kategorimenu_id' => 'required',
            'price' => 'required',
            'image' => 'mimes:png,jpg,jpeg,svg,webp',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        if ($request->image <> '') {
            $image = $request->file('image');
            $namaimage = 'Menu-'.strtolower(str_replace(' ', '-', $request->get('name'))).'-'.Str::random(5).'.'.$image->extension();
            $tujuan = 'images';
            $image->move(public_path($tujuan), $namaimage);
            $imageName = $tujuan.'/'.$namaimage;
        }

        $menu = Menu::find($id);
        $menu->name = $request->get('name');
        $menu->kategorimenu_id = $request->get('kategorimenu_id');
        $menu->price = $request->get('price');
        $menu->description = $request->get('description');
        if ($request->image <> '') {
            File::delete($menu->image);

            $menu->image = $imageName;
        }
        $menu->save();

        return redirect()->route('sistem.menu')->with('success', 'Berhasil mengupdate menu.');
    }

    // Proses menghapus menu
    public function destroy($id)
    {
        $menu = Menu::find($id);
        $menu->delete();

        File::delete($menu->image);

        return redirect()->route('sistem.menu')->with('success', 'Berhasil menghapus menu.');
    }
}

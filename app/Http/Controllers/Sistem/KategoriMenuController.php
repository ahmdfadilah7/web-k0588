<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\KategoriMenu;
use App\Models\Setting;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;

class KategoriMenuController extends Controller
{
    // Menampilkan halaman kategori menu
    public function index()
    {
        $setting = Setting::first();
        return view('sistem.kategorimenu.index', compact('setting'));
    }

    // proses menampilkan data dengan datatables
    public function listData()
    {
        $data = KategoriMenu::query();
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('sistem.kategorimenu.edit', $row->id).'" class="btn btn-primary btn-sm" style="margin-right:10px;">
                            <i class="ti ti-edit"></i>
                        </a>';
                $btn .= '<a href="'.route('sistem.kategorimenu.delete', $row->id).'" class="btn btn-danger btn-sm">
                        <i class="ti ti-trash"></i>
                    </a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        
        return $datatables;
    }

    // Menampilkan halaman tambah kategori menu
    public function create()
    {
        $setting = Setting::first();
        return view('sistem.kategorimenu.add', compact('setting'));
    }

    // Proses menambahkan data ke database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        KategoriMenu::create([
            'title' => $request->get('title')
        ]);

        return redirect()->route('sistem.kategorimenu')->with('success', 'Berhasil menambahkan kategori menu.');
    }

    // Menampilkan halaman edit kategori menu
    public function edit($id)
    {
        $setting = Setting::first();
        $kategorimenu = KategoriMenu::find($id);

        return view('sistem.kategorimenu.edit', compact('setting', 'kategorimenu'));
    }

    // Proses edit kategori menu
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        $kategorimenu = KategoriMenu::find($id);
        $kategorimenu->title = $request->get('title');
        $kategorimenu->save();

        return redirect()->route('sistem.kategorimenu')->with('success', 'Berhasil update kategori menu.');
    }

    // Proses hapus kategori menu
    public function destroy($id)
    {
        $kategorimenu = KategoriMenu::find($id);
        $kategorimenu->delete();

        return redirect()->route('sistem.kategorimenu')->with('success', 'Berhasil menghapus kategori menu.');
    }
}

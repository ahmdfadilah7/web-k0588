<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\Meja;
use App\Models\Setting;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MejaController extends Controller
{
    //Menampilkan halaman meja
    public function index()
    {
        $setting = Setting::first();
        return view('sistem.meja.index', compact('setting'));
    }

    // proses menampilkan data dengan datatables
    public function listData()
    {
        $data = Meja::query();
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('qrcode', function($row) {
                $qrcode = '<img src="'.url($row->qrcode).'" width="70">';
                return $qrcode;
            })
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('sistem.meja.edit', $row->id).'" class="btn btn-primary btn-sm" style="margin-right:10px;">
                            <i class="ti ti-edit"></i>
                        </a>';
                $btn .= '<a href="'.route('sistem.meja.delete', $row->id).'" class="btn btn-danger btn-sm">
                        <i class="ti ti-trash"></i>
                    </a>';
                return $btn;
            })
            ->rawColumns(['action', 'qrcode'])
            ->make(true);
        
        return $datatables;
    }

    // Menampilkan halaman tambah meja
    public function create()
    {
        $setting = Setting::first();
        return view('sistem.meja.add', compact('setting'));
    }

    // Proses menambahkan data ke database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        $setting = Setting::first();

        $username = strtolower(str_replace(' ','-', $request->get('name')));
        $qrcode = QrCode::format('png')
                    ->size(200)
                    ->generate(route('login_qrcode', ['table' => $username]));
        $nameqrcode = 'QrCode-'.str_replace(' ','-',$request->get('name')).'-'.Str::random(4).'.png';
        $tujuanfolder = 'qr-code';
        $output_file = $tujuanfolder.'/'.$nameqrcode;
        Storage::disk('public')->put($output_file, $qrcode);

        Meja::create([
            'name' => $request->get('name'),
            'username' => $username,
            'qrcode' => 'images/'.$output_file,
            'password' => Hash::make('123456')
        ]);

        return redirect()->route('sistem.meja')->with('success', 'Berhasil menambahkan meja.');
    }

    // Menampilkan halaman edit meja
    public function edit($id)
    {
        $setting = Setting::first();
        $meja = Meja::find($id);

        return view('sistem.meja.edit', compact('setting', 'meja'));
    }

    // Proses mengedit data ke database
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        $setting = Setting::first();

        $meja = Meja::find($id);
        $username = strtolower(str_replace(' ', '-', $request->get('name')));

        if ($meja->name <> $request->get('name')) {
            $meja->name = $request->get('name');

            $meja->username = $username;

            File::delete($meja->qrcode);

            $qrcode = QrCode::format('png')
                        ->size(200)
                        ->generate(route('login_qrcode', ['table' => $username]));
            $nameqrcode = 'QrCode-'.str_replace(' ','-',$request->get('name')).'-'.Str::random(4).'.png';
            $tujuanfolder = 'qr-code';
            $output_file = $tujuanfolder.'/'.$nameqrcode;
            Storage::disk('public')->put($output_file, $qrcode);

            $meja->qrcode = 'images/'.$output_file;
        } else {
            $meja->name = $request->get('name');
        }
        $meja->save();

        return redirect()->route('sistem.meja')->with('success', 'Berhasil menambahkan meja.');
    }

    public function destroy($id)
    {
        $meja = Meja::find($id);
        $meja->delete();

        File::delete($meja->qrcode);

        return redirect()->route('sistem.meja')->with('success', 'Berhasil menghapus data.');
    }
}

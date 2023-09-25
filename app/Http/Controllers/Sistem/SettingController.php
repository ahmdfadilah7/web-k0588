<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DataTables;

class SettingController extends Controller
{
    // Menampilkan halaman Setting Website
    public function index()
    {
        $setting = Setting::first();
        return view('sistem.setting.index', compact('setting'));
    }

    // proses menampilkan data dengan datatables
    public function listData()
    {
        $data = Setting::query();
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('logo', function($row) {
                $logo = '<img src="'.url($row->logo).'" width="70">';
                return $logo;
            })
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('sistem.setting.edit', $row->id).'" class="btn btn-primary btn-sm mr-2">
                            <i class="ti ti-edit"></i>
                        </a>';
                return $btn;
            })
            ->rawColumns(['action', 'logo'])
            ->make(true);
        
        return $datatables;
    }

    // Menampilkan halaman tambah
    public function create()
    {
        $setting = Setting::first();
        return view('sistem.setting.add', compact('setting'));
    }

    // Proses menambahkan data ke database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_website' => 'required',
            'email' => 'required|email',
            'no_telp' => 'required',
            'gambar_header' => 'mimes:png,jpg,jpeg,svg',
            'logo' => 'mimes:png,jpg,jpeg,svg',
            'favicon' => 'mimes:png,jpg,jpeg,svg',
            'address' => 'required',
            'about_us' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        $tujuanfolder = 'images';
        if ($request->logo <> '') {
            $logo = $request->file('logo');
            $namelogo = 'Logo-'.str_replace(' ','-',$request->get('name_website')).'-'.Str::random(4).'.'.$logo->extension();
            $logo->move(public_path($tujuanfolder), $namelogo);
            $namaLogo = $tujuanfolder.'/'.$namelogo;
        } else {
            $namaLogo = '';
        }

        if ($request->gambar_header <> '') {
            $header = $request->file('gambar_header');
            $nameheader = 'Header-'.str_replace(' ','-',$request->get('name_website')).'-'.Str::random(4).'.'.$header->extension();
            $header->move(public_path($tujuanfolder), $nameheader);
            $namaHeader = $tujuanfolder.'/'.$nameheader;
        } else {
            $namaHeader = '';
        }

        if ($request->favicon <> '') {
            $favicon = $request->file('favicon');
            $namefavicon = 'Favicon-'.str_replace(' ','-',$request->get('name_website')).'-'.Str::random(4).'.'.$favicon->extension();
            $favicon->move(public_path($tujuanfolder), $namefavicon);
            $namaFavicon = $tujuanfolder.'/'.$namefavicon;
        } else {
            $namaFavicon = '';
        }

        Setting::create([
            'name_website' => $request->get('name_website'),
            'email' => $request->get('email'),
            'no_telp' => $request->get('no_telp'),
            'gambar_header' => $namaHeader,
            'logo' => $namaLogo,
            'favicon' => $namaFavicon,
            'address' => $request->get('address'),
            'about_us' => $request->get('about_us')
        ]);

        return redirect()->route('sistem.setting')->with('success', 'Berhasil Menambahkan Setting.');
    }

    // Menampilkan halaman edit setting
    public function edit($id)
    {
        $setting = Setting::find($id);

        return view('sistem.setting.edit', compact('setting'));
    }

    // Proses update setting
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name_website' => 'required',
            'email' => 'required|email',
            'no_telp' => 'required',
            'gambar_header' => 'mimes:png,jpg,jpeg,svg',
            'logo' => 'mimes:png,jpg,jpeg,svg',
            'favicon' => 'mimes:png,jpg,jpeg,svg',
            'address' => 'required',
            'about_us' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        $tujuanfolder = 'images';
        if ($request->logo <> '') {
            $logo = $request->file('logo');
            $namelogo = 'Logo-'.str_replace(' ','-',$request->get('name_website')).'-'.Str::random(4).'.'.$logo->extension();
            $logo->move(public_path($tujuanfolder), $namelogo);
            $namaLogo = $tujuanfolder.'/'.$namelogo;
        }

        if ($request->gambar_header <> '') {
            $header = $request->file('gambar_header');
            $nameheader = 'Header-'.str_replace(' ','-',$request->get('name_website')).'-'.Str::random(4).'.'.$header->extension();
            $header->move(public_path($tujuanfolder), $nameheader);
            $namaHeader = $tujuanfolder.'/'.$nameheader;
        }

        if ($request->favicon <> '') {
            $favicon = $request->file('favicon');
            $namefavicon = 'Favicon-'.str_replace(' ','-',$request->get('name_website')).'-'.Str::random(4).'.'.$favicon->extension();
            $favicon->move(public_path($tujuanfolder), $namefavicon);
            $namaFavicon = $tujuanfolder.'/'.$namefavicon;
        }

        $setting = Setting::find($id);
        $setting->name_website = $request->get('name_website');
        $setting->email = $request->get('email');
        $setting->no_telp = $request->get('no_telp');
        if ($request->logo <> '') {
            $setting->logo = $namaLogo;
        }
        if ($request->gambar_header <> '') {
            $setting->gambar_header = $namaHeader;
        }
        if ($request->favicon <> '') {
            $setting->favicon = $namaFavicon;
        }
        $setting->address = $request->get('address');
        $setting->about_us = $request->get('about_us');
        $setting->save();

        return redirect()->route('sistem.setting')->with('success', 'Update setting berhasil.');
    }

}

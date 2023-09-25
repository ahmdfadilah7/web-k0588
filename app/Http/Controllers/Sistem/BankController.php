<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Setting;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BankController extends Controller
{
    // Menampilkan halaman bank
    public function index()
    {
        $setting = Setting::first();

        return view('sistem.bank.index', compact('setting'));
    }

    // proses menampilkan data dengan datatables
    public function listData()
    {
        $data = Bank::query();
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('logo', function($row) {
                $image = '<img src="'.url($row->logo).'" width="70">';
                return $image;
            })
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('sistem.bank.edit', $row->id).'" class="btn btn-primary btn-sm" style="margin-right:10px;">
                            <i class="ti ti-edit"></i>
                        </a>';
                $btn .= '<a href="'.route('sistem.bank.delete', $row->id).'" class="btn btn-danger btn-sm">
                        <i class="ti ti-trash"></i>
                    </a>';
                return $btn;
            })
            ->rawColumns(['action', 'logo'])
            ->make(true);
        
        return $datatables;
    }

    // Menampilkan halaman tambah bank
    public function create()
    {
        $setting = Setting::first();
        
        return view('sistem.bank.add', compact('setting'));
    }

    // Proses menambahkan bank
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_bank' => 'required',
            'logo' => 'mimes:png,jpg,jpeg,svg,webp'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        if ($request->logo <> '') {
            $logo = $request->file('logo');
            $namelogo = 'Bank-'.str_replace(' ', '-', $request->get('name_bank')).'-'. Str::random(5).'.'.$logo->extension();
            $tujuan = 'images';
            $logo->move(public_path($tujuan), $namelogo);
            $logoName = $tujuan.'/'.$namelogo;
        } else {
            $logoName = '';
        }

        Bank::create([
            'name_bank' => $request->get('name_bank'),
            'logo' => $logoName
        ]);

        return redirect()->route('sistem.bank')->with('success', 'Berhasil menambahkan bank.');
    }

    // Menampilkan halaman edit bank
    public function edit($id)
    {
        $setting = Setting::first();
        $bank = Bank::find($id);

        return view('sistem.bank.edit', compact('setting', 'bank'));
    }

    // Proses mengupdate bank
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name_bank' => 'required',
            'logo' => 'mimes:png,jpg,jpeg,svg,webp'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        if ($request->logo <> '') {
            $logo = $request->file('logo');
            $namelogo = 'Bank-'.str_replace(' ', '-', $request->get('name_bank')).'-'. Str::random(5).'.'.$logo->extension();
            $tujuan = 'images';
            $logo->move(public_path($tujuan), $namelogo);
            $logoName = $tujuan.'/'.$namelogo;
        } else {
            $logoName = '';
        }

        $bank = Bank::find($id);
        $bank->name_bank = $request->get('name_bank');
        if ($request->logo <> '') {
            $bank->logo = $logoName;
        }
        $bank->save();

        return redirect()->route('sistem.bank')->with('success', 'Berhasil mengupdate bank.');
    }

    // Menghapus data bank
    public function destroy($id)
    {
        $bank = Bank::find($id);
        $bank->delete();

        File::delete($bank->logo);

        return redirect()->route('sistem.bank')->with('success', 'Berhasil menghapus bank.');
    }
}

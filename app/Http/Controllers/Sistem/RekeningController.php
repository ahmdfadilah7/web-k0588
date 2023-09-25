<?php

namespace App\Http\Controllers\Sistem;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Rekening;
use App\Models\Setting;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RekeningController extends Controller
{
    // Menampilkan halaman rekening
    public function index()
    {
        $setting = Setting::first();

        return view('sistem.rekening.index', compact('setting'));
    }

    // proses menampilkan data dengan datatables
    public function listData()
    {
        $data = Rekening::join('banks', 'rekenings.bank_id', 'banks.id')
            ->select('rekenings.*', 'banks.logo');
        $datatables = DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('logo', function($row) {
                $image = '<img src="'.url($row->logo).'" width="70">';
                return $image;
            })
            ->addColumn('action', function($row) {
                $btn = '<a href="'.route('sistem.rekening.edit', $row->id).'" class="btn btn-primary btn-sm" style="margin-right:10px;">
                            <i class="ti ti-edit"></i>
                        </a>';
                $btn .= '<a href="'.route('sistem.rekening.delete', $row->id).'" class="btn btn-danger btn-sm">
                        <i class="ti ti-trash"></i>
                    </a>';
                return $btn;
            })
            ->rawColumns(['action', 'logo'])
            ->make(true);
        
        return $datatables;
    }

    // Menampilkan halaman tambah rekening
    public function create()
    {
        $setting = Setting::first();
        $bank = Bank::get();
        
        return view('sistem.rekening.add', compact('setting', 'bank'));
    }

    // Proses menambahkan rekening
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bank_id' => 'required',
            'name_rekening' => 'required',
            'no_rekening' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        Rekening::create([
            'bank_id' => $request->get('bank_id'),
            'name_rekening' => $request->get('name_rekening'),
            'no_rekening' => $request->get('no_rekening'),
        ]);

        return redirect()->route('sistem.rekening')->with('success', 'Berhasil menambahkan rekening.');
    }

    // Menampilkan halaman edit rekening
    public function edit($id)
    {
        $setting = Setting::first();
        $rekening = rekening::find($id);
        $bank = Bank::get();

        return view('sistem.rekening.edit', compact('setting', 'rekening', 'bank'));
    }

    // Proses mengupdate rekening
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'bank_id' => 'required',
            'name_rekening' => 'required',
            'no_rekening' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return back()->with('errors', $errors)->withInput($request->all());
        }

        $rekening = Rekening::find($id);
        $rekening->bank_id = $request->get('bank_id');
        $rekening->name_rekening = $request->get('name_rekening');
        $rekening->no_rekening = $request->get('no_rekening');
        $rekening->save();

        return redirect()->route('sistem.rekening')->with('success', 'Berhasil mengupdate rekening.');
    }

    // Menghapus data rekening
    public function destroy($id)
    {
        $rekening = Rekening::find($id);
        $rekening->delete();

        return redirect()->route('sistem.rekening')->with('success', 'Berhasil menghapus rekening.');
    }
}

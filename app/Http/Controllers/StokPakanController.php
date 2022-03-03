<?php

namespace App\Http\Controllers;

use App\Exports\StokPakanExport;
use App\Models\StokPakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class StokPakanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stok = StokPakan::latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $stok
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'total_berat' => 'required|numeric',
            'harga' => 'required|numeric',
            'tgl_beli' => 'required|date_format:Y-m-d',
            'tgl_expired' => 'required|date_format:Y-m-d',
            'note' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $stok = StokPakan::create([
            'nama' => $request->nama,
            'total_berat' => $request->total_berat,
            'harga' => $request->harga,
            'tgl_beli' => $request->tgl_beli,
            'tgl_expired' => $request->tgl_expired,
            'note' => $request->note,
        ]);

        if ($stok) {
            return response()->json([
                'status' => true,
                'message' => 'Created !',
                'data' => $stok
            ], 201);
        }
        return response()->json([
            'status' => false,
            'message' => 'Fail',
        ], 500);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StokPakan  $stokPakan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $stok = StokPakan::find($id);
        if ($stok) {
            $stok->update([
                'nama' => $request->nama,
                'total_berat' => $request->total_berat,
                'harga' => $request->harga,
                'tgl_beli' => $request->tgl_beli,
                'tgl_expired' => $request->tgl_expired,
                'note' => $request->note,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $stok
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => 'Fail',
        ], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StokPakan  $stokPakan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stok = StokPakan::find($id);

        if ($stok) {
            $stok->delete();
            return response()->json([
                'status' => true,
                'message' => 'Success'
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Fail',
        ], 500);
    }

    // show stok pakan

    public function show($id)
    {
        $pakan = StokPakan::find($id);
        if ($pakan) {
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $pakan
            ], 200);
        }

        return response()->json([
            'status' => true,
            'message' => 'Not found',
        ], 404);
    }

    public function export()
    {
        return Excel::download(new StokPakanExport, 'stok_pakan.xlsx');
    }

    // list pakan
    public function list()
    {
        $pakan = StokPakan::all()->load('inputstokpakan');
        $hasil = collect($pakan)->map(function ($value, $key) {
            $sisa = collect($value->inputstokpakan)->sum('jumlah');
            $total = $sisa * $value->harga;
            if ($sisa > 0) {
                $collection =  collect($value)->put('pakan_terpakai', $sisa)->put('biaya_terpakai', $total);
                return $collection;
            }
            return $value;
        });
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $hasil
        ], 200);
    }
}

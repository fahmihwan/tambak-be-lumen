<?php

namespace App\Http\Controllers;

use App\Exports\TambakExport;
use App\Models\Tambak;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class TambakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tambak = Tambak::latest()->get();
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $tambak
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
        $validate = Validator::make($request->all(), [
            'nama' => 'required',
            'negara' => 'required',
            'alamat' => 'required',
            'jumlah_kolam' => 'required|numeric',
            'zona_waktu' => 'required',
            'nama_awal_kolam' => 'required',
            'luas' => 'required|numeric',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validate->errors()
            ], 400);
        }
        $tambak = Tambak::create([
            'nama' => $request->nama,
            'negara' => $request->negara,
            'alamat' => $request->alamat,
            'jumlah_kolam' => $request->jumlah_kolam,
            'zona_waktu' => $request->zona_waktu,
            'nama_awal_kolam' => $request->nama_awal_kolam,
            'luas' => $request->luas,
        ]);

        if ($tambak) {
            return response()->json([
                'status' => true,
                'message' => 'Created',
                'data' => $tambak
            ], 201);
        }

        return response()->json([
            'status' => false,
            'message' => 'Error'
        ], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tambak  $tambak
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {
        $tambak = Tambak::find($id);
        if ($tambak) {
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $tambak
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Not found !!!'
        ], 404);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tambak  $tambak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'nama' => 'required',
            'negara' => 'required',
            'alamat' => 'required',
            'jumlah_kolam' => 'required|numeric',
            'zona_waktu' => 'required',
            'nama_awal_kolam' => 'required',
            'luas' => 'required|numeric',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validate->errors()
            ], 400);
        }
        $tambak = Tambak::find($id);
        if ($tambak) {
            $tambak->update([
                'nama' => $request->nama,
                'negara' => $request->negara,
                'alamat' => $request->alamat,
                'jumlah_kolam' => $request->jumlah_kolam,
                'zona_waktu' => $request->zona_waktu,
                'nama_awal_kolam' => $request->nama_awal_kolam,
                'luas' => $request->luas,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $tambak
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
     * @param  \App\Tambak  $tambak
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tambak = Tambak::find($id);

        if ($tambak) {
            $tambak->delete();
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

    // export exel
    public function export()
    {
        return Excel::download(new TambakExport, 'tambak.xlsx');
    }


    // route list kolam
    // public function list(Request $request)
    // {
    //     $tambak =  Tambak::all()->load('kolams');
    //     $data = [];
    //     foreach ($tambak as $t) {
    //         foreach ($t->kolams as $k) {
    //             foreach ($k->sikluses as $s) {
    //                 $tanggal1 = new DateTime($s->tgl_tebar);
    //                 $tanggal2 = new DateTime();

    //                 $perbedaan = $tanggal2->diff($tanggal1)->format("%a");
    //                 array_push($data, [
    //                     'umur_kolam' => $perbedaan,
    //                     'tgl_selesai' => $s->lama_budidaya - $s->umur_awal_udang
    //                 ]);
    //             }
    //         }
    //     }
    //     $tambak = collect($tambak)->map(function ($value, $item) use ($data) {
    //         for ($i = 0; $i < count($data); $i++) {
    //             $value =  collect($value)->put('umur_kolam', $data[$i]['umur_kolam'])->put('tgl_selesai', $data[$i]['tgl_selesai']);
    //             if ($item > $i) {
    //                 $value =  collect($value)->put('umur_kolam', '')->put('tgl_selesai', '');
    //             }
    //         }
    //         return $value;
    //     });
    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Success',
    //         'data' => $tambak
    //     ], 200);
    // }
}

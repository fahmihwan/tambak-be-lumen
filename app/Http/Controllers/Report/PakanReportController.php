<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\InputPakan;
use App\Models\Kolam;
use App\Models\Siklus;
use App\Models\Tambak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

use function PHPSTORM_META\map;

class PakanReportController extends Controller
{
    public function tampil(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tambak_id' => 'required',
            'kolam_id' => 'required',
            'batch' => 'required|date_format:Y-m-d'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors(),
            ], 400);
        }

        $tambak = Tambak::find($request->tambak_id);
        $kolam = Kolam::where('tambak_id', $tambak->id)->where('id', $request->kolam_id)->first();
        $siklus = Siklus::where('kolam_id', $kolam->id)->where('tgl_tebar', $request->batch)->get();
        $stokpakan = collect($kolam->inputpakan)->map(function ($value) {
            return $value->stokpakan;
        });
        $totalpakan = collect($kolam->inputpakan)->sum('jumlah');
        $pakanterpakai = collect($stokpakan)->sum('total_berat');
        $pakanterpakai = $pakanterpakai - $totalpakan;
        $totalharga = collect($stokpakan)->map(function ($value) use ($totalpakan) {
            return collect($value)->put('total_harga', $value->harga * $totalpakan);
        });
        $inputpakan = collect($kolam->inputpakan)->map(function ($value) {
            return collect($value)->forget('stokpakan');
        });

        $kolam = collect($kolam)->put('inputpakan', $inputpakan)->put('stokpakan', $totalharga)->put('pakan_terpakai', $pakanterpakai)->put('total_pakan', $totalpakan)->put('sikluses', $siklus);
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $kolam
        ], 200);
    }
}

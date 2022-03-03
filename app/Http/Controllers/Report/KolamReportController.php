<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Kolam;
use App\Models\Siklus;
use App\Models\Tambak;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KolamReportController extends Controller
{
    public function tampil(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tambak_id' => 'required',
            'kolam_id' => 'required',
            'batch' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'messge' => $validator->errors()
            ], 400);
        }
        $tambak = Tambak::with('kolams')->find($request->tambak_id);
        $kolam = Kolam::where('tambak_id', $tambak->id)->where('id', $request->kolam_id)->first();
        $sikluses = Siklus::where('kolam_id', $kolam->id)->where('tgl_tebar', $request->batch)->get();
        $pakan = collect($kolam->inputpakan)->sum('jumlah');
        $filter = collect($sikluses)->filter(function ($value) {
            return collect($value->panens)->isNotEmpty();
        });
        $sikluses = collect($filter)->map(function ($value) use ($pakan) {
            return collect($value->panens)->map(function ($panen) use ($value, $pakan) {
                $biomasa  = $pakan / $value->target_sr;
                $target_sr = $value->total_tebar * ($value->target_sr / 100);
                $panen_sr = $biomasa / $value->total_tebar * 100;
                $tgl1 = new DateTime($value->tgl_tebar);
                $tgl2 = new DateTime($panen->tgl);
                $jarak = $tgl2->diff($tgl1)->d;
                return collect($value)->put('doc', $jarak)->put('biomasa', $biomasa)->put('sr_target', $target_sr)->put('panen_sr', $panen_sr);
            });
        });
        $kolam = collect($kolam)->put('total_pakan', $pakan)->put('sikluses', $sikluses);

        return response()->json([
            'status' => true,
            'message' => false,
            'data' => $kolam
        ], 200);
    }
}

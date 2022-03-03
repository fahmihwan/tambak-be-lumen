<?php

namespace App\Http\Controllers;

use App\Models\Siklus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiklusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siklus = Siklus::latest()->get();
        $siklus = collect($siklus)->map(function ($value) {
            return collect($value)->forget('panens');
        });

        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $siklus
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
            'kolam_id' => 'required',
            'tgl_tebar' => 'required|date_format:Y-m-d',
            'total_tebar' => 'required|numeric',
            'perhitungan' => 'required',
            'spesies_udang' => 'required',
            'umur_awal_udang' => 'required|numeric',
            'target_sr' => 'required|numeric',
            'lama_budidaya' => 'required|numeric',
            'note' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $siklus = Siklus::create([
            'kolam_id' => $request->kolam_id,
            'tgl_tebar' => $request->tgl_tebar,
            'total_tebar' => $request->total_tebar,
            'perhitungan' => $request->perhitungan,
            'spesies_udang' => $request->spesies_udang,
            'umur_awal_udang' => $request->umur_awal_udang,
            'target_sr' => $request->target_sr,
            'lama_budidaya' => $request->lama_budidaya,
            'note' => $request->note
        ]);

        if ($siklus) {
            return response()->json([
                'status' => true,
                'message' => 'Created !',
                'data' => $siklus
            ], 201);
        }

        return response()->json([
            'status' => false,
            'message' => 'Fail',
        ], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Siklus  $siklus
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $siklus = Siklus::find($id);

        if ($siklus) {
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $siklus
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
     * @param  \App\Siklus  $siklus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tgl_tebar' => 'required|date_format:Y-m-d',
            'total_tebar' => 'required|numeric',
            'perhitungan' => 'required',
            'spesies_udang' => 'required',
            'umur_awal_udang' => 'required|numeric',
            'target_sr' => 'required|numeric',
            'lama_budidaya' => 'required|numeric',
            'note' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $siklus = Siklus::find($id);

        if ($siklus) {
            $siklus->update([
                'tgl_tebar' => $request->tgl_tebar,
                'total_tebar' => $request->total_tebar,
                'perhitungan' => $request->perhitungan,
                'spesies_udang' => $request->spesies_udang,
                'umur_awal_udang' => $request->umur_awal_udang,
                'target_sr' => $request->target_sr,
                'lama_budidaya' => $request->lama_budidaya,
                'note' => $request->note
            ]);

            return response()->json([[
                'status' => true,
                'message' => 'Success',
                'data' => $siklus
            ]], 200);
        }
        return response()->json([
            'status' => false,
            'message' => 'Not found !!!'
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Siklus  $siklus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siklus = Siklus::find($id);
        if ($siklus) {
            $siklus->delete();
            return response()->json([
                'status' => true,
                'message' => 'Success'
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Fails'
        ], 404);
    }
}

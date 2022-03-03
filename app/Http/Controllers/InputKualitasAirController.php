<?php

namespace App\Http\Controllers;

use App\Models\InputKualitasAir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InputKualitasAirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inputKualitasAir = InputKualitasAir::latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $inputKualitasAir
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
            'suhu_kolam' => 'required|numeric',
            'tgl' => 'required|date_format:Y-m-d',
            'waktu' => 'required',
            'note' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $inputKualitasAir = InputKualitasAir::create([
            'kolam_id' => $request->kolam_id,
            'suhu_kolam' => $request->suhu_kolam,
            'tgl' => $request->tgl,
            'waktu' => $request->waktu,
            'note' => $request->note
        ]);

        if ($inputKualitasAir) {
            return response()->json([
                'status' => true,
                'message' => 'Created !',
                'data' => $inputKualitasAir
            ], 201);
        }

        return response()->json([
            'status' => false,
            'message' => 'Fails'
        ], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InputKualitasAir  $inputKualitasAir
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inputKualitasAir = InputKualitasAir::find($id);

        if ($inputKualitasAir) {
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $inputKualitasAir
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => 'Not found!'
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InputKualitasAir  $inputKualitasAir
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'suhu_kolam' => 'required|numeric',
            'tgl' => 'required|date_format:Y-m-d',
            'waktu' => 'required',
            'note' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $inputKualitasAir = InputKualitasAir::find($id);

        if ($inputKualitasAir) {
            $inputKualitasAir->update([
                'suhu_kolam' => $request->suhu_kolam,
                'tgl' => $request->tgl,
                'waktu' => $request->waktu,
                'note' => $request->note
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $inputKualitasAir
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Fails'
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InputKualitasAir  $inputKualitasAir
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inputKualitasAir = InputKualitasAir::find($id);

        if ($inputKualitasAir) {
            $inputKualitasAir->delete();
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

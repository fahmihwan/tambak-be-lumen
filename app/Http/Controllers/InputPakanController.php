<?php

namespace App\Http\Controllers;

use App\Models\InputPakan;
use App\Models\StokPakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InputPakanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inputpakan = InputPakan::latest()->get();
        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $inputpakan
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
            'stok_pakan_id' => 'required',
            'tgl' => 'required|date_format:Y-m-d',
            'waktu' => 'required',
            'jumlah' => 'required|numeric',
            'note' => "required"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $inputpakan = InputPakan::create([
            'kolam_id' => $request->kolam_id,
            'stok_pakan_id' => $request->stok_pakan_id,
            'tgl' => $request->tgl,
            'waktu' => $request->waktu,
            'jumlah' => $request->jumlah,
            'note' => $request->note

        ]);

        if ($inputpakan) {
            return response()->json([
                'status' => true,
                'message' => 'Created !',
                'data' => $inputpakan
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
     * @param  \App\InputPakan  $inputPakan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inputpakan = InputPakan::find($id);

        if ($inputpakan) {
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $inputpakan
            ], 200);
        }

        return response()->json([
            'status' => false,
            'message' => 'Not found'
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InputPakan  $inputPakan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'stok_pakan_id' => 'required',
            'tgl' => 'required|date_format:Y-m-d',
            'waktu' => 'required',
            'jumlah' => 'required|numeric',
            'note' => "required"
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 400);
        }
        $inputpakan = InputPakan::find($id);

        if ($inputpakan) {
            $inputpakan->update([
                'stok_pakan_id' => $request->stok_pakan_id,
                'tgl' => $request->tgl,
                'waktu' => $request->waktu,
                'jumlah' => $request->jumlah,
                'note' => $request->note
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $inputpakan
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
     * @param  \App\InputPakan  $inputPakan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inputpakan = InputPakan::find($id);

        if ($inputpakan) {
            $inputpakan->delete();
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

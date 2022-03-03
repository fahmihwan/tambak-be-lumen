<?php

namespace App\Http\Controllers;

use App\Models\Panen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PanenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $panen = Panen::latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $panen
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
            'siklus_id' => 'required',
            'tgl' => 'required|date_format:Y-m-d',
            'total' => 'required|numeric',
            'jml_udang' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'status' => 'required',
            'note' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $panen = Panen::create([
            'siklus_id' => $request->siklus_id,
            'tgl' => $request->tgl,
            'total' => $request->total,
            'jml_udang' => $request->jml_udang,
            'harga_jual' => $request->harga_jual,
            'status' => $request->status,
            'note' => $request->note
        ]);

        if ($panen) {
            return response()->json([
                'status' => true,
                'message' => 'Created!',
                'data' => $panen
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
     * @param  \App\Panen  $panen
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $panen = Panen::find($id);

        if ($panen) {
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $panen
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
     * @param  \App\Panen  $panen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tgl' => 'required|date_format:Y-m-d',
            'total' => 'required|numeric',
            'jml_udang' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'status' => 'required',
            'note' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $panen = Panen::find($id);

        if ($panen) {
            $panen->update([
                'tgl' => $request->tgl,
                'total' => $request->total,
                'jml_udang' => $request->jml_udang,
                'harga_jual' => $request->harga_jual,
                'status' => $request->status,
                'note' => $request->note
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $panen
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
     * @param  \App\Panen  $panen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $panen = Panen::find($id);

        if ($panen) {
            $panen->delete();
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

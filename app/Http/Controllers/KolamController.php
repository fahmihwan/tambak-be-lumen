<?php

namespace App\Http\Controllers;

use App\Models\Kolam;
use App\Models\Tambak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KolamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kolam = Kolam::latest()->get();
        return response()->json([
            'status' => true,
            'message' => 'Success !',
            'data' => $kolam
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
            'tambak_id' => 'required',
            'nama' => 'required',
            'luas' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $kolam = Kolam::create([
            'tambak_id' => $request->tambak_id,
            'nama' => $request->nama,
            'luas' => $request->luas
        ]);

        if ($kolam) {
            return response()->json([
                'status' => true,
                'message' => 'Created !',
                'data' => $kolam
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
     * @param  \App\Kolam  $kolam
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kolam = Kolam::find($id);
        if ($kolam) {
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $kolam
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => 'Fail',
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kolam  $kolam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'luas' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $kolam = Kolam::find($id);
        if ($kolam) {
            $kolam->update([
                'nama' => $request->nama,
                'luas' => $request->luas
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $kolam
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => 'Fail',
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kolam  $kolam
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kolam = Kolam::find($id);

        if ($kolam) {
            $kolam->delete();
            return response()->json([
                'status' => true,
                'message' => 'Success'
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => 'Fail',
        ], 404);
    }
}

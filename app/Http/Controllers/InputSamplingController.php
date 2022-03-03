<?php

namespace App\Http\Controllers;

use App\Models\InputSampling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InputSamplingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inputSampling = InputSampling::latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'Success',
            'data' => $inputSampling
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
            'tgl' => 'required|date_format:Y-m-d',
            'waktu' => 'required',
            'berat_udang' => 'required|numeric',
            'note' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $inputSampling = InputSampling::create([
            'kolam_id' => $request->kolam_id,
            'tgl' => $request->tgl,
            'waktu' => $request->waktu,
            'berat_udang' => $request->berat_udang,
            'note' => $request->note
        ]);

        if ($inputSampling) {
            return response()->json([
                'status' => true,
                'message' => 'Created !',
                'data' => $inputSampling
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
     * @param  \App\InputSampling  $inputSampling
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inputSampling = InputSampling::find($id);

        if ($inputSampling) {
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $inputSampling
            ], 200);
        }

        return response()->json([
            'status' => true,
            'message' => 'Not found!'
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InputSampling  $inputSampling
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tgl' => 'required|date_format:Y-m-d',
            'waktu' => 'required',
            'berat_udang' => 'required|numeric',
            'note' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => $validator->errors()
            ], 400);
        }

        $inputSampling = InputSampling::find($id);

        if ($inputSampling) {
            $inputSampling->update([
                'tgl' => $request->tgl,
                'waktu' => $request->waktu,
                'berat_udang' => $request->berat_udang,
                'note' => $request->note
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $inputSampling
            ], 200);
        }

        return response()->json([
            'status' => true,
            'message' => 'Fails'
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InputSampling  $inputSampling
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inputSampling = InputSampling::find($id);

        if ($inputSampling) {
            $inputSampling->delete();
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

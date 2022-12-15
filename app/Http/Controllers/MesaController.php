<?php

namespace App\Http\Controllers;

use App\Http\Resources\MesaResourse;
use App\Models\Mesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Mesa::get();
        //$mesas = Mesa::paginate();
        //return MesaResourse::collection($mesas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'numero' => 'required|unique:mesas|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'message' => $validator->errors(),
            ]);
        }
        Mesa::create([
            'numero' => $request->numero,
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'mesa agregada successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mesa  $mesa
     * @return \Illuminate\Http\Response
     */
    public function show(Mesa $mesa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mesa  $mesa
     * @return \Illuminate\Http\Response
     */
    public function edit(Mesa $mesa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mesa  $mesa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mesa $mesa)
    {
        $validator = Validator::make($request->all(), [
            'numero' => 'required|unique:mesas|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'message' => $validator->errors(),
            ]);
        }

        $mesa = Mesa::where('id', $request->id)->FirstOrFail();

        $mesa->numero = $request->numero;

        $mesa->save();

        return response()->json([
            'status' => 200,
            'message' => 'mesa editada successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mesa  $mesa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mesa $mesa)
    {
        $mesa->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Mesa eliminada successfully',
        ]);
    }
}

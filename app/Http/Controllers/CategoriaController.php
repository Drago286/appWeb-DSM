<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast;
use Illuminate\Support\Facades\Validator;


class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Categoria::get();

        //
    }

    public function obtenerNombreCategoria($id)
    {
        $categoria = Categoria::where('id', $id)->FirstOrFail();
        return $categoria;
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
            'nombre' => 'required|unique:categorias|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'message' => $validator->errors(),
            ]);
        }
        Categoria::create([
            'nombre' => $request->nombre,
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'categoria agregado successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categoria $categoria)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|unique:categorias|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'message' => $validator->errors(),
            ]);
        }

        $categoria = Categoria::where('id', $request->id)->FirstOrFail();

        $categoria->nombre = $request->nombre;
        $categoria->save();

        return response()->json([
            'status' => 200,
            'message' => 'categoria editada successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
    }
}

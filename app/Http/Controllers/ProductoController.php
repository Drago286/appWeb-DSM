<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;


class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Producto::get();

        //
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
            'codigo' => 'required|unique:productos',
            'nombre' => 'required|unique:productos',
            'descripcion' => 'required',
            'precio' => 'required|min:1',
            'stock' => 'required|min:1',
            'categoria_id' => 'required',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'message' => $validator->errors(),
            ]);
        }
        Producto::create([
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'stock' => $request->stock,
            'categoria_id' => $request->categoria_id,
        ]);
        return response()->json([
            'status' => 200,
            'message' => 'producto agregado successfully',
        ]);



        // $producto = new Producto;
        // $producto->codigo = $request->codigo;
        // $producto->nombre = $request->nombre;
        // $producto->descripcion = $request->descripcion;
        // $producto->precio = $request->precio;
        // $producto->categoria_id = $request->categoria_id;
        // $producto->stock = $request->stock;


        // Producto::create([
        //     'codigo' => $producto->codigo,
        //     'nombre' => $producto->nombre,
        //     'descripcion' => $producto->descripcion,
        //     'precio' => $producto->precio,
        //     'stock' => $producto->stock,
        //     'categoria_id' => $producto->categoria_id,

        // ]);

        return response()->json([
            'status' => 200,
            'message' => 'Producto agregado successfully',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $producto = Producto::where('id', $request->id)->FirstOrFail();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->categoria_id = $request->categoria_id;


        $producto->save();

        return response()->json([
            'status' => 200,
            'message' => 'Producto editado successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        //$producto = Producto::where('id', $request->id)->FirstOrFail();

        $producto->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Producto eliminado successfully',
        ]);
    }
}

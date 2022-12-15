<?php

namespace App\Http\Controllers;

use App\Models\Resumen_orden;
use App\Models\Producto;
use App\Models\Resumen_orden_producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ResumenOrdenController extends Controller
{
    /**
     * retorna la vista con las lista de ordenes
     *
     * @return void
     */
    public function index()
    {
        $resumen_pedidos = Resumen_orden::all();
        //where('estado', 'PENDIENTE');
        //$ordenes = DB::table('resumen_orden_productos')->where('resumen_orden_id', '=', $resumen_pedidos->id)->get();

        return view("administrarOrdenes")->with([
            "resumen_pedidos" => $resumen_pedidos
            //"detalle" => $detalle,

        ]);
    }
    /**
     * Retorna el resumen_orden segun el ID recibido
     */

    public function detallesOrden(int $resumen_orden_id)
    {

        $ordenes = DB::table('resumen_orden_productos')->where('resumen_orden_id', '=', $resumen_orden_id)->get();

        return response()->json($ordenes);
    }


    /**
     * Desglosa el REQUEST entre el detalle del pedido, como los productos que posee.
     */
    public function saveOrder(Request $request)
    {

        $arr = [
            'order' => [

                'montoTotal' => $request->montoTotal,
                'mesa_id' => $request->mesa_id,
                'estado' => $request->estado

            ],
            'detallesOrden' => $request->resumen_orden_productos

        ];

        $order = Resumen_orden::create($arr['order']);
        $detallesOrden = $request->resumen_orden_productos;
        foreach ($detallesOrden as $detalle) {
            $producto = Producto::where('id', $detalle['producto_id'],)->FirstOrFail();
            $producto->stock = $producto->stock - $detalle['cantidad'];
            $producto->save();
            Resumen_orden_producto::create([
                'resumen_orden_id' => $order->id,
                'producto_id' => $detalle['producto_id'],
                'cantidad' => $detalle['cantidad']
            ]);
        }

        return Resumen_orden_producto::get();
    }
    /**
     * RETORNA los pedidos donde el estado sea PENDIENTE
     */
    public function listar_pedidos()
    {

        $pedidos = Resumen_orden::where('estado', 'PENDIENTE')->simplePaginate(10);

        return view("administrarOrdenes")->with('resumen_ordens', $pedidos);
    }
    /**
     * Cambia el estado del pedido a EN PREPARACION
     *
     * @param [type] $id
     * @return void
     */
    public function atenderOrden($id)
    {

        $pedido = Resumen_orden::where('id', $id)->get()->first();

        $pedido->estado = 'EN PREPARACION';
        $pedido->save();
        return redirect(route('index'));
    }
}

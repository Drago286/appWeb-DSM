<?php

namespace App\Http\Controllers;

use App\Models\Resumen_orden;
use App\Models\Resumen_orden_producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ResumenOrdenController extends Controller
{
    public function index()
    {
        $resumen_pedidos = Resumen_orden::all();
        //$ordenes = DB::table('resumen_orden_productos')->where('resumen_orden_id', '=', $resumen_pedidos->id)->get();

        return view("administrarOrdenes")->with([
            "resumen_pedidos" => $resumen_pedidos
            //"detalle" => $detalle,

        ]);
    }

    //  public function detallesOrden(int $idOrden)
    //  {
    //     $orden=Resumen_orden::find($idOrden);
    //     $detallesOrden=$orden->detallesOrden;

    //     foreach($detallesOrden as $orden_){
    //         $element=[];

    //         $element['cantidad']=$orden_->cant;


    //     }

    //     return response()->json($detallesOrden)
    // }
    // public function listar_pedidos()
    // {

    // }

    public function detallesOrden(int $resumen_orden_id)
    {
        // $ordenes = Resumen_orden_producto::where('resumen_orden_id', '2');
        // $id = $idOrden->id_;

        $ordenes = DB::table('resumen_orden_productos')->where('resumen_orden_id', '=', $resumen_orden_id)->get();
        //$orden = DB::table('resumen_orden_productos')->where('resumen_orden_id', $idOrden)->value('producto_id');

        // foreach ($orden as $orden_) {
        //     $element['producto_id'] = $orden_->producto_id;

        //     $element['cantidad'] = $orden_->cantidad;
        // }
        //$orden = Resumen_orden_producto::all();

        //retornar modal con la informacion del pedido
        return response()->json($ordenes);
    }


    public function saveOrder(Request $request)
    {

        $arr = [
            'order' => [

                'montoTotal' => $request->montoTotal,
                'mesa_id' => $request->mesa_id,

            ],
            'detallesOrden' => $request->resumen_orden_productos

        ];

        $order = Resumen_orden::create($arr['order']);
        $detallesOrden = $request->resumen_orden_productos;
        foreach ($detallesOrden as $detalle) {
            Resumen_orden_producto::create([
                'resumen_orden_id' => $order->id,
                'producto_id' => $detalle['producto_id'],
                'cantidad' => $detalle['cantidad']
            ]);
        }

        return Resumen_orden_producto::get();
    }
    public function listar_pedidos()
    {
        $pedidos = resumen_orden::all();

        return view("administrarOrdenes")->with('reumen_ordens', $pedidos);
    }
    public function atender_orden()
    {
    }
}

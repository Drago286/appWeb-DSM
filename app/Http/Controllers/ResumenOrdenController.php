<?php

namespace App\Http\Controllers;

use App\Models\Resumen_orden;
use App\Models\Resumen_orden_producto;
use Illuminate\Http\Request;

class ResumenOrdenController extends Controller
{
    public function index()
    {
        return Resumen_orden::get();
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
}

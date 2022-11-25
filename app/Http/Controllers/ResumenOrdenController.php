<?php

namespace App\Http\Controllers;

use App\Models\Resumen_orden;
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
}

<?php

namespace App\Http\Controllers;

use App\Models\Resumen_orden_producto;
use Illuminate\Http\Request;

class ResumenOrdenProductoController extends Controller
{
    public function index()
    {
        return Resumen_orden_producto::get();
    }
}

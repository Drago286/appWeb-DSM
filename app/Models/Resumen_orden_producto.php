<?php

namespace App\Models;

use App\Http\Controllers\ResumenOrdenProductoController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resumen_orden_producto extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [

        'cantidad',
        'producto_id',
        'resumen_orden_id',


    ];

    public function productoId()
    {

        return $this->belongsTo(Producto::class, 'producto_id');;
    }


    public function resumen_orden_id()
    {

        return $this->belongsTo(Resumen_orden::class, 'resumen_orden_id');;
    }
}

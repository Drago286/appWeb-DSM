<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resumen_orden extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [

        'mesa_id',
        'montoTotal',

    ];

    public function mesaId()
    {

        return $this->belongsTo(Mesa::class, 'mesa_id');;
    }

    public function detallesOrden(){
        return $this->hasMany(Resumen_orden_producto::class,'resumen_orden_id');
    }
}

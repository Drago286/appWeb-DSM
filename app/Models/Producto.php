<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [

        'codigo',
        'nombre',
        'categoria_id',
        'imagen',
        'descripcion',
        'precio',
    ];
}

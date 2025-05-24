<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
     public $timestamps = false; 
        protected $fillable = [
        'carrito_id',
        'usuario_id',
        'fecha_compra',
        'monto_pagado',
        'monto_bruto',
        'descuento_total',
    ];

    public function carrito()
    {
        return $this->belongsTo(Carrito::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}

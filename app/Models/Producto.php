<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Producto extends Model
{
     use HasFactory, Notifiable;

   
    protected $fillable = [
        'nombre',
        'descripcion' ,   
        'precio',
    ];

    public function carritos()
{
    return $this->belongsToMany(Carrito::class, 'carrito_productos')
                ->withPivot('cantidad', 'precio_unitario');
              
}

}

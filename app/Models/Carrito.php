<?php

namespace App\Models;

use App\Enums\EstadoCarrito;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class Carrito extends Model
{
    use HasFactory, Notifiable;
 public $timestamps = false;
    protected $fillable = [
        'estado',
        'fecha_simulada',
        'fecha_finalizacion',
        'tipo',
        'usuario_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'carrito_productos')
                    ->withPivot('cantidad', 'precio_unitario');
                   
    }
}


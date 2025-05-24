<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarritoController extends Controller
{
     public function getProductos():JsonResponse{
        $carritos= DB::table('carritos')
        ->join('users', 'carritos.usuario_id', '=', 'users.id')
        ->select(
            'carritos.id',
            'carritos.tipo',
            'carritos.fecha_simulada',
            'carritos.fecha_finalizacion',
            'carritos.estado',
            'users.name as usuario_nombre',
            'users.vip as usuario_vip'
        )
        ->get();
        return response()->json($carritos);
     }


     public function productosPorCarrito($id)
{
    $carrito = Carrito::with('productos')->findOrFail($id);

    return response()->json([
        'carrito_id' => $carrito->id,
        'productos' => $carrito->productos->map(function ($producto) {
            return [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio_unitario' => $producto->pivot->precio_unitario,
                'cantidad' => $producto->pivot->cantidad,
            ];
        }),
    ]);
}

}

<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarritoController extends Controller
{
    public function getCarritos(): JsonResponse
    {
        $carritos = DB::table('carritos')
            ->join('users', 'carritos.usuario_id', '=', 'users.id')
            ->select(
                'carritos.id',
                'carritos.tipo',
                'carritos.fecha_simulada',
                'carritos.fecha_finalizacion',
                'carritos.estado',
                'users.name as usuario_nombre',
                'users.is_vip as usuario_vip'
            )
            ->get();
        return response()->json($carritos);
    }




    public function syncProductos(Request $request, $id)
{
    $carrito = Carrito::findOrFail($id);

    // Limpiar productos actuales del carrito
    $carrito->productos()->detach();

    // Agregar los productos nuevos desde Angular
    foreach ($request->productos as $producto) {
        $carrito->productos()->attach($producto['id'], [
            'cantidad' => $producto['cantidad'],
            'precio_unitario' => $producto['precio_unitario'], // usa el nombre correcto
        ]);
    }

    return response()->json([
        'message' => 'Carrito sincronizado correctamente.',
    ]);
}


public function store(Request $request)
{
    $data = $request->validate([
        'usuario_id' => 'required|exists:users,id',
        'tipo' => 'required|string',
        'fecha_simulada' => 'required|date',
        'productos' => 'required|array',
        'productos.*.producto_id' => 'required|exists:productos,id',
        'productos.*.cantidad' => 'required|integer|min:1',
        'productos.*.precio_unitario' => 'required|numeric|min:0',
    ]);

    $carrito = Carrito::create([
        'usuario_id' => $data['usuario_id'],
        'tipo' => $data['tipo'],
        'estado' => 'activo',
        'fecha_simulada' => $data['fecha_simulada'],
        'fecha_finalizacion' => now()->addDays(7),
    ]);

    foreach ($data['productos'] as $producto) {
        $carrito->productos()->attach($producto['producto_id'], [
            'cantidad' => $producto['cantidad'],
            'precio_unitario' => $producto['precio_unitario'],
        ]);
    }

    return response()->json(['carrito_id' => $carrito->id], 201);
}


public function update(Request $request, $id)
{
    $carrito = Carrito::findOrFail($id);

    $productos = $request->input('productos');

    
    $datosParaSync = [];

    foreach ($productos as $producto) {
        $datosParaSync[$producto['producto_id']] = [
            'cantidad' => $producto['cantidad'],
            'precio_unitario' => $producto['precio_unitario'],
        ];
    }

    
    $carrito->productos()->syncWithoutDetaching($datosParaSync);

    return response()->json(['message' => 'Carrito actualizado correctamente']);
}


public function destroy($id)
{
    $carrito = Carrito::find($id);
    if (!$carrito) {
        return response()->json(['message' => 'Carrito no encontrado'], 404);
    }


    $carrito->productos()->detach();

  
    $carrito->delete();

    return response()->json(['message' => 'Carrito eliminado correctamente'], 200);
}

}

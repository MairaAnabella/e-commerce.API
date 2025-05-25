<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Compra;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CompraController extends Controller
{
     public function getCompra():JsonResponse{
        $compra=DB::table('compras')
        ->select('*')
        ->get();
        return response()->json($compra);
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'carrito_id' => 'required|exists:carritos,id',
        'usuario_id' => 'required|exists:users,id',
        'fecha_compra' => 'required|date',
        'monto_pagado' => 'required|numeric',
        'monto_bruto' => 'required|numeric',
        'descuento_total' => 'required|numeric',
    ]);

    try {
        $compra = Compra::create($validated);

        // Marcar el carrito como finalizado
        $carrito = Carrito::find($validated['carrito_id']);
        $carrito->estado = 'finalizado';
        $carrito->save(); 
        
        return response()->json([
            'message' => 'Compra registrada con éxito',
            'compra' => $compra
        ], 201);
    } catch (\Exception $e) {
        Log::error('Error al registrar la compra: ' . $e->getMessage());
        return response()->json([
            'message' => 'Error al registrar la compra',
            'error' => $e->getMessage()
        ], 500);
    }
}

public function comprasFinalizadasPorUsuario($usuarioId)
{
    $compras = Compra::with(['carrito.productos']) // productos del carrito
        ->where('usuario_id', $usuarioId)
        ->whereHas('carrito', function ($query) {
            $query->where('estado', 'finalizado');
        })
        ->get();

    return response()->json($compras);
}


   
}


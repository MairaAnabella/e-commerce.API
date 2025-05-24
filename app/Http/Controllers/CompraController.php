<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;

class CompraController extends Controller
{
    public function index()
    {
        $compras = Compra::with(['carrito', 'usuario'])->get();

        return response()->json($compras);
    }

    public function show($id)
    {
        $compra = Compra::with(['carrito', 'usuario'])->findOrFail($id);

        return response()->json($compra);
    }
}


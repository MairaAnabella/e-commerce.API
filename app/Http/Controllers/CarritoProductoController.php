<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarritoProductoController extends Controller
{
     public function getCarritoProducto():JsonResponse{
        $carritoProducto=DB::table('carrito_productos')
        ->select('*')
        ->get();
        return response()->json($carritoProducto);
    }
}

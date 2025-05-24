<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
      public function getProductos():JsonResponse{
        $productos=DB::table('productos')
        ->select('*')
        ->get();
        return response()->json($productos);
    }
}

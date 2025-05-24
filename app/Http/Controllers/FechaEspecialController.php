<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FechaEspecialController extends Controller
{
    public function getFechaEspecial():JsonResponse{
        $fechaEspecial=DB::table('fechas_especiales')
        ->select('*')
        ->get();
        return response()->json($fechaEspecial);
    }
}

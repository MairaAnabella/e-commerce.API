<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class reporteController extends Controller
{
  
public function clientesVipActuales(Request $request):JsonResponse{
        $clientesVip=DB::table('users')
        ->select('*')
        ->where('is_vip',1)
        ->get();
        return response()->json($clientesVip);
    }

public function clientesQueSeVolvieronVip(Request $request)
{
 $mes = $request->input('mes');
    $anio = $request->input('anio');

    $primerDia = date("$anio-$mes-01");
    $ultimoDia = date("Y-m-t", strtotime($primerDia));

    $clientesVip = DB::table('users')
        ->select('*')
        ->whereBetween('fecha_alta_vip', [$primerDia, $ultimoDia])
        ->where('is_vip', 1) 
        ->get();

    return response()->json($clientesVip);
}

public function clientesQueDejaronDeSerVip(Request $request)
{
     $mes = $request->input('mes');
    $anio = $request->input('anio');

    $primerDia = date("$anio-$mes-01");
    $ultimoDia = date("Y-m-t", strtotime($primerDia));

    $clientesVip = DB::table('users')
        ->select('*')
        ->whereNotNull('fecha_baja_vip')
        ->whereBetween('fecha_baja_vip', [$primerDia, $ultimoDia])
        ->where('is_vip', 0) 
        ->get();

    return response()->json($clientesVip);
}
}

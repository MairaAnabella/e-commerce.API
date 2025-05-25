<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class reporteController extends Controller
{
  
public function clientesVipActuales(Request $request)
{
    $mes = $request->input('mes'); // '05'
    $anio = $request->input('anio'); // '2025'

    $fechaInicio = Carbon::createFromDate($anio, $mes)->startOfMonth();
    $fechaFin = Carbon::createFromDate($anio, $mes)->endOfMonth();

    $clientesVip = DB::table('compras')
        ->select('usuario_id', DB::raw('SUM(monto_pagado) as total_compras'))
        ->whereBetween('fecha_compra', [$fechaInicio, $fechaFin])
        ->groupBy('usuario_id')
        ->having('total_compras', '>', 10000)
        ->get();

    return response()->json($clientesVip);
}

public function clientesQueSeVolvieronVip(Request $request)
{
    $mes = $request->input('mes');
    $anio = $request->input('anio');

    $fechaActual = Carbon::createFromDate($anio, $mes);
    $inicioMes = $fechaActual->copy()->startOfMonth();
    $finMes = $fechaActual->copy()->endOfMonth();

    $inicioMesAnterior = $fechaActual->copy()->subMonth()->startOfMonth();
    $finMesAnterior = $fechaActual->copy()->subMonth()->endOfMonth();

    // IDs de usuarios VIP este mes
    $vipEsteMes = DB::table('compras')
        ->select('usuario_id')
        ->whereBetween('fecha_compra', [$inicioMes, $finMes])
        ->groupBy('usuario_id')
        ->havingRaw('SUM(monto_pagado) > 10000')
        ->pluck('usuario_id');

    // IDs de usuarios que NO fueron VIP el mes anterior
    $noVipMesAnterior = DB::table('compras')
        ->select('usuario_id')
        ->whereBetween('fecha_compra', [$inicioMesAnterior, $finMesAnterior])
        ->groupBy('usuario_id')
        ->havingRaw('SUM(monto_pagado) <= 10000')
        ->pluck('usuario_id');

    $nuevosVip = $vipEsteMes->diff($noVipMesAnterior);

    return response()->json(User::whereIn('id', $nuevosVip)->get());
}

public function clientesQueDejaronDeSerVip(Request $request)
{
    $mes = $request->input('mes');
    $anio = $request->input('anio');

    $fechaActual = Carbon::createFromDate($anio, $mes);
    $inicioMes = $fechaActual->copy()->startOfMonth();
    $finMes = $fechaActual->copy()->endOfMonth();

    $inicioMesAnterior = $fechaActual->copy()->subMonth()->startOfMonth();
    $finMesAnterior = $fechaActual->copy()->subMonth()->endOfMonth();

    $vipMesAnterior = DB::table('compras')
        ->select('usuario_id')
        ->whereBetween('fecha_compra', [$inicioMesAnterior, $finMesAnterior])
        ->groupBy('usuario_id')
        ->havingRaw('SUM(monto_pagado) > 10000')
        ->pluck('usuario_id');

    $vipEsteMes = DB::table('compras')
        ->select('usuario_id')
        ->whereBetween('fecha_compra', [$inicioMes, $finMes])
        ->groupBy('usuario_id')
        ->havingRaw('SUM(monto_pagado) > 10000')
        ->pluck('usuario_id');

    $dejaronDeSerVip = $vipMesAnterior->diff($vipEsteMes);

    return response()->json(User::whereIn('id', $dejaronDeSerVip)->get());
}
}

<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CarritoProductoController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\FechaEspecialController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\reporteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Models\FechaEspecial;

Route::get('/users', [UserController::class, 'getUser']);
Route::get('/fechaEspecial', [FechaEspecialController::class, 'getFechaEspecial']);
Route::get('/producto', [ProductoController::class, 'getProductos']);
Route::post('carritos/{id}/sync', [CarritoController::class, 'syncProductos']);
Route::post('/carritos', [CarritoController::class, 'store']);
Route::delete('carritos/{id}', [CarritoController::class, 'destroy']);
Route::put('/carritos/{id}', [CarritoController::class, 'update']);
Route::post('/compras', [CompraController::class, 'store']);
Route::get('/compras/finalizadas/{usuarioId}', [CompraController::class, 'comprasFinalizadasPorUsuario']);


Route::get('/reportes/clientes-vip-actuales', [ReporteController::class, 'clientesVipActuales']);
Route::post('/reportes/clientes-alta-vip', [ReporteController::class, 'clientesQueSeVolvieronVip']);
Route::post('/reportes/clientes-baja-vip', [ReporteController::class, 'clientesQueDejaronDeSerVip']);





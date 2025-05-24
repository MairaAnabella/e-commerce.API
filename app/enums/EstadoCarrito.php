<?php

namespace App\Enums;

enum EstadoCarrito: string
{
    case Activo = 'activo';
    case Vencido = 'vencido';
    case Cancelado = 'cancelado';
}

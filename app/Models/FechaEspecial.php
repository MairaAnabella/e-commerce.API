<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class FechaEspecial extends Model
{
    use HasFactory, Notifiable;
    protected $fillable=[
        'fecha',
        'descripcion',
        'tipo'
      

    ];
}

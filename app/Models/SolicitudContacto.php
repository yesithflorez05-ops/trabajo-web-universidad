<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitudContacto extends Model
{
    use HasFactory;

    protected $table = 'solicitudes_contacto'; 

    protected $fillable = [
        'nombre', 
        'correo', 
        'mensaje',
        'estado',
        'atendido_por',
        'respuesta_admin', 
    ];

    public function atendidoPor()
    {
        return $this->belongsTo(User::class, 'atendido_por');
    }
}
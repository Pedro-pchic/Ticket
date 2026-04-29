<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'user_id',
        'tecnico_id',
        'departamento',
        'ubicacion',
        'extension',
        'equipo_afectado',
        'titulo',
        'descripcion',
        'categoria',
        'prioridad',
        'estado',
        'adjunto',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tecnico()
    {
        return $this->belongsTo(User::class, 'tecnico_id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrega extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'venta_id',
        'costo',
        'fecha_entrega',
        'status',
        'aprobado_por',
        'user_id',
    ];

    /**
     * Relaciones
     */

    // Relación con la venta (muchos a uno)
    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    // Relación con el usuario que aprobó (muchos a uno)
    public function aprobadoPor()
    {
        return $this->belongsTo(User::class, 'aprobado_por');
    }

    // Relación con el usuario responsable de la entrega (muchos a uno)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

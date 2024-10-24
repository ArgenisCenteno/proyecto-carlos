<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'status',
    ];

    public function subCategorias()
    {
        return $this->hasMany(SubCategoria::class, 'categoria_id');
    }
}
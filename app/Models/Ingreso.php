<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;

    protected $primaryKey = 'ingresoID';

    protected $fillable = [
        'cantidad_ingresada',
        'productoid',
    ];
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'productoid');
    }

    
}
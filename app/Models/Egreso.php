<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egreso extends Model
{
    use HasFactory;

    protected $primaryKey = 'egresoID';

    protected $fillable = [
        'cantidad_egresada',
        'productoID',
    ];
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'productoID');
    }

    
}
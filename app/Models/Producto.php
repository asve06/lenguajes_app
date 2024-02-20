<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey = 'productoid';

    protected $fillable = [
        'nombre',
        'precio',
        'descripcion',
        'existencia_actual',
        'categoriaID',
        'proveedorID',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoriaID');
    }
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedorID');
    }


    //protected $fillable = ['nombre','descripcion'];
}

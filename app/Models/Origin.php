<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Origin extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'origins';

    protected $primaryKey = 'originID';

    protected $fillable = [
            'name',
            'surname',
            'number',
            'address'
        ];
}

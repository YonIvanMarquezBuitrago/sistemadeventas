<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    public function productos()
    {
        /*Relación Uno a Muchos, Una Categoría tiene muchos productos*/
        return $this->hasMany(Producto::class);
    }
}

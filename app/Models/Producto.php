<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public function categoria()
    {
        /*Relación Pertenece a, Un Producto pertenece a una sola Categoría*/
        return $this->belongsTo(Categoria::class);
    }
}

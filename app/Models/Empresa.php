<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    /*Crear relacion de modelo empresa con modelo usuario*/
    public function users()
    {
        /*Relacion uno a muchos*/
        return $this->hasMany(User::class);
    }
}

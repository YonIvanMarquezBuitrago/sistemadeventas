<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('proveedors', function (Blueprint $table) {
            $table->id();

            $table->string('empresa');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('email');
            $table->string('nombre');
            $table->string('celular');

            //Campo llave foranea, relación con la Tabla Empresas
            $table->unsignedBigInteger('empresa_id');//la llave foranea debe tener el mismo tipo que el campo origen

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedors');
    }
};

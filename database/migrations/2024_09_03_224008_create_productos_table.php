<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();

            $table->string('codigo')->unique();
            $table->string('nombre')->unique();
            $table->text('descripcion')->nullable();
            $table->text('imagen')->nullable();
            $table->integer('stock');
            $table->integer('stock_minimo');
            $table->integer('stock_maximo');
            $table->decimal('precio_compra', 8, 2);
            $table->decimal('precio_venta', 8, 2);
            $table->date('fecha_ingreso');

                        //Campo llave foranea, relación con la Tabla Categorias
            $table->unsignedBigInteger('categoria_id');//la llave foranea debe tener el mismo tipo que el campo origen
            $table->foreign('categoria_id')
                ->references('id')
                ->on('categorias')
                ->onUpdate('cascade')
                ->onDelete('cascade');

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
        Schema::dropIfExists('productos');
    }
};

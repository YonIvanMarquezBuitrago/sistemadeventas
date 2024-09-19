<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'codigo'=>$this->faker->unique()->ean13(), //Código único
            'nombre'=>$this->faker->word(), //nombre aleatorio
            'descripcion'=>$this->faker->sentence(), //descripcion aleatoria
            'imagen'=>$this->faker->imageUrl(640,480,'products',true), //URL de una imagen aleatoria
            'stock'=>$this->faker->numberBetween(10,100), //stock entre 10 y 100
            'stock_minimo'=>$this->faker->numberBetween(5,10), //stock_minimo entre 5 y 10
            'stock_maximo'=>$this->faker->numberBetween(50,200), //stock_maximo entre 50 y 200
            'precio_compra'=>$this->faker->randomFloat(2,1000,200000), //precio_compra entre 1000 y 200000
            'precio_venta'=>$this->faker->randomFloat(2,2000,500000), //precio_venta entre 2000 y 500000
            'fecha_ingreso'=>$this->faker->date(), //fecha_ingreso aleatoria
            /*'categoria_id'=>\App\Models\Categoria::factory(), //Relación con la Tabla Categorias*/
            'categoria_id'=>3, //Categorias Equipos
            'empresa_id'=>1,
        ];
    }
}

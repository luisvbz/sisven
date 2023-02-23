<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    public function definition()
    {
        return [
            'status' => true,
            'type_id' => random_int(1,3),
            'code' => Str::of(Str::random(8))->upper(),
            'description' => ['ORO','ORO ROSA','NEGRO', 'AZUL','PLATEADO', 'ROSA','MORADO'][random_int(0,6)],
            'minimun_stock' => random_int(500,3000),
            'measure_id' => 1,
            'price' => random_int(15,50),
            'cost' => random_int(5,30),
        ];
    }
}

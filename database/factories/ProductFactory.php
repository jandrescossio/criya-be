<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Retailer;
use App\Models\Lookup;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->sentence($this->faker->numberBetween(2, 10)),
            'description' => $this->faker->text($this->faker->numberBetween(100, 1000)),
            'image' => 'image-' . $this->faker->numberBetween(1, 20) . '.jpeg',
            'size' => $this->faker->text($this->faker->numberBetween(10, 50)),
            'url' => $this->faker->url(),
            'in_stock' => $this->faker->numberBetween(0, 1),
            'price' => $this->faker->randomFloat(2, 200, 10000),
            'retailer_id' => Retailer::inRandomOrder()->first()->id,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            $product->lookups()->attach(Lookup::where('key', 'TYPE')->inRandomOrder()->limit(random_int(1, 5))->get());
            $product->lookups()->attach(Lookup::where('key', 'VENDOR')->inRandomOrder()->limit(random_int(1, 5))->get());
            $product->lookups()->attach(Lookup::where('key', 'COLOR')->inRandomOrder()->limit(random_int(1, 5))->get());
            $product->lookups()->attach(Lookup::where('key', 'SETTINGS')->inRandomOrder()->limit(random_int(1, 5))->get());
            $product->lookups()->attach(Lookup::where('key', 'DESIGNER')->inRandomOrder()->limit(random_int(1, 5))->get());
            $product->lookups()->attach(Lookup::where('key', 'MATERIAL')->inRandomOrder()->limit(random_int(1, 5))->get());
        });
    }
}

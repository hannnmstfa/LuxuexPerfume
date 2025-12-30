<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProdukFactory extends Factory
{
    public function definition(): array
    {
        $nama = $this->faker->words(3, true);
        $harga = $this->faker->numberBetween(50000, 500000);

        return [
            'nama' => ucfirst($nama),
            'slug' => Str::slug($nama),
            'kategori' => $this->faker->randomElement(['pria', 'wanita']),
            'deskripsi' => $this->faker->paragraphs(3, true),
            'harga' => $harga,
            'harga_diskon' => $this->faker->boolean(30)
                ? $harga - $this->faker->numberBetween(5000, 30000)
                : null,
            'path_foto' => Str::slug($nama) . '.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

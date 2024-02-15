<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Portfolio>
 */
class PortfolioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => '<p>' . implode('</p><p>', $this->faker->paragraphs(2)) . '</p>',
            'thumbnail' => $this->randomThumbnail(),
            'is_published' => true,
        ];
    }

    public function randomThumbnail(): bool|string
    {
        $name = $this->faker->slug;
        $file = UploadedFile::fake()->image($name.'.png', 500, 380);
        return $file->storeAs('thumbnails', $file->name, 'public');
    }
}

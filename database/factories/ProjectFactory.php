<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $array = ['laravel', 'scss', 'js'];
        return [
            'title' => fake()->title(),
            'image' => 'not_found.png',
            'stack' => json_encode($array),
            'link' => 'https://github.com/olegtemek'
        ];
    }
}

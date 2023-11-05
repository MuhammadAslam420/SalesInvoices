<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Setting>
 */
class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>$this->faker->name,
            'logo'=>'logo.png',
            'address'=>$this->faker->streetAddress,
            'phone'=>$this->faker->phoneNumber,
            'email'=>$this->faker->safeEmail(),
            'notes'=>$this->faker->paragraph()
        ];
    }
}

<?php

namespace Database\Factories;

use App\Domain\Contracts\CheckContract;
use App\Models\Check;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CheckFactory extends Factory
{
    protected $model = Check::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            CheckContract::USER_ID => User::query()
                                          ->inRandomOrder()
                                          ->first() ? User::query()
                                                          ->inRandomOrder()
                                                          ->first()->id : null,
            CheckContract::IMAGE   => $this->faker->imageUrl(640, 480),
            CheckContract::TYPE    => $this->faker->randomElement(['обычный', 'призовой']),
            CheckContract::CODE    => $this->faker->postcode,
            CheckContract::STATUS  => $this->faker->randomElement(['Принят', 'Отклонен']),
        ];
    }
}

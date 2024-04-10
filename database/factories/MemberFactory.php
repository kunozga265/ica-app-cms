<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "avatar"=>"images/avatar.png",
            'first_name' => $this->faker->firstName,
            "middle_name"=>$this->faker->firstName,
            "last_name"=>$this->faker->lastName,
            "gender"=>$this->faker->boolean ? "Male" : "Female",
            "date_of_birth"=>Carbon::create(2000,1,1)->getTimestamp(),
            "phone_number"=>"+265997748584",
            "email"=>$this->faker->email,
        ];
    }
}

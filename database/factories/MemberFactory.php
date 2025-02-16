<?php

namespace Database\Factories;

use App\Http\Controllers\Web\AppController;
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
            "code"=>(new AppController())->generateUniqueCode(),
            "avatar"=>"images/avatar.png",
            'first_name' => $this->faker->firstName,
            "middle_name"=>$this->faker->firstName,
            "last_name"=>$this->faker->lastName,
            "gender"=>$this->faker->boolean ? "Male" : "Female",
            "date_of_birth"=>Carbon::createFromTimestamp($this->faker->numberBetween(910093600, 1712737755))->getTimestamp(),
            "phone_number_airtel"=>"+265997748584",
            "email"=>$this->faker->email,
        ];
    }
}

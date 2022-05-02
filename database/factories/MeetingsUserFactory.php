<?php

namespace Database\Factories;

use App\Models\MeetingsUser;
use App\Models\Meeting;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class MeetingsUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MeetingsUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $rsvp_opts = [
          "yes",
          "no",
          "maybe"
        ];

        return [
            'meeting_id' => $this->faker->numberBetween(0, 1000),
            'user_id' => $this->faker->numberBetween(0, 1000),
            'response' => $rsvp_opts[rand(0,2)]
        ];
    }
}

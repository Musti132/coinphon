<?php

namespace Database\Factories;

use App\Models\Notification;
use App\Models\NotificationType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Notification::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => 'Bitcoin',
            'message' => 'Hello this is a notification',
            'type_id' => NotificationType::all()->random(1)->first()->id,
            'user_id' => User::all()->random(1)->first()->id
        ];
    }
}

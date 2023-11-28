<?php

namespace Database\Factories;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Follow>
 */
class FollowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $followerId = User::get()->random()->id;
        $followedId = User::get()->random()->id;

        // Check if the follow relationship already exists
        $isFollowing = Follow::where('user_id', $followerId)
            ->where('followed_id', $followedId)
            ->exists();

        // If the relationship already exists, generate new random user ids
        while ($isFollowing) {
            $followerId = User::get()->random()->id;
            $followedId = User::get()->random()->id;

            $isFollowing = Follow::where('user_id', $followerId)
                ->where('followed_id', $followedId)
                ->exists();
        }

        return [
            'user_id' => $followerId,
            'followed_id' => $followedId,
        ];

        // return [
        //     'user_id' => User::get()->random()->id,
        //     'followed_id' => User::get()->random()->id,
        //     // une date aléatoire entre -2 mois et maintenant
        //     // 'created_at' => fake()->dateTimeBetween('-2 months', 'now'),
        // ];
    }
}

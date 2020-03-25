<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\DrawTicket;
use App\User;

$factory->define(DrawTicket::class, function (Faker $faker) {
    return [
        'ticket_number' => random_int(config('luckydraw.start'), config('luckydraw.end')),
        'user_id' => factory(User::class)
    ];
});

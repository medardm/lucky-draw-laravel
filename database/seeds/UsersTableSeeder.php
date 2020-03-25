<?php

use Illuminate\Database\Seeder;
use App\Models\DrawTicket;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Create 5 users with 10 tickets */
        $users10Tickets = factory(User::class, 5)->create()->each(function ($user) {
            $user->tickets()->createMany(
                factory(DrawTicket::class, 10)
                ->make(['user_id' => $user->id])->toArray()
            );
        });
        /* Create 5 users with 7 tickets */
        $users10Tickets = factory(User::class, 5)->create()->each(function ($user) {
            $user->tickets()->createMany(
                factory(DrawTicket::class, 7)
                ->make(['user_id' => $user->id])->toArray()
            );
        });

        /* Create 10 users with 5 tickets */
        $users5Tickets = factory(User::class, 10)->create()->each(function ($user) {
            $user->tickets()->createMany(
                factory(DrawTicket::class, 5)
                    ->make(['user_id' => $user->id])->toArray()
            );
        });
    }
}

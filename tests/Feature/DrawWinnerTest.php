<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\Models\Prize;
use App\Models\DrawTicket;
use App\Models\User\Member;
use App\Models\PrizeUser;
use App\User;

class DrawWinnerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRandomGrandPrize()
    {
        /* Create 4 users with 7 tickets */
        $users10Tickets = factory(User::class, 4)->create()->each(function ($user) {
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


        // find random winner
        $prize = Prize::first();
        $winner = $prize->findRandomWinner();

        $this->assertInstanceOf(User::class, $prize->winners()->find($winner->id));

        // may only have one winner
        $winner2 = $prize->findRandomWinner();
        $this->assertFalse($prize->winners->contains($winner2));

        // should not be available
        $winner2 = $prize->findRandomWinner();
        $this->assertFalse($prize->isAvailable);
    }
}

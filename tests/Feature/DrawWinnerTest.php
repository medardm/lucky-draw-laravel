<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\Models\Prize;
use App\Models\DrawTicket;
use App\Models\User\Member;
use App\Models\User\Winner;
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

        // find random winner from users with most number of tickets
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

    public function testRandomSecondPrize()
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


        // find random winner for 2nd prize
        $prize = Prize::find(2);
        $winner = $prize->findRandomWinner();

        $this->assertInstanceOf(User::class, $prize->winners()->find($winner->id));

        // may only have two winners
        $winner2 = $prize->findRandomWinner();
        $this->assertTrue($prize->winners->contains($winner2));
        // should not be included
        $winner3 = $prize->findRandomWinner();
        $this->assertFalse($prize->winners->contains($winner3));

        // should not be available
        $winner2 = $prize->findRandomWinner();
        $this->assertFalse($prize->isAvailable);
    }

    public function testRandomThirdPrize()
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


        // find random winner for 3rd prize
        $prize = Prize::find(3);
        $winner = $prize->findRandomWinner();

        $this->assertInstanceOf(User::class, $prize->winners()->find($winner->id));

        // may only have three winners
        $winner2 = $prize->findRandomWinner();
        $this->assertTrue($prize->winners->contains($winner2));
        $prize->refresh();

        $winner3 = $prize->findRandomWinner();
        $prize->refresh();
        $this->assertTrue($prize->winners->contains($winner3));
        // should not be included
        $winner4 = $prize->findRandomWinner();
        $this->assertFalse($prize->winners->contains($winner4));

        // should not be available
        $winner2 = $prize->findRandomWinner();
        $this->assertFalse($prize->isAvailable);
    }

    public function testManualPrize()
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


        // set manual winner for Grand prize
        $prize = Prize::find(1);
        $ticket = DrawTicket::all()->random();
        $winner = $prize->give($ticket->user, $ticket->ticket_number);
        $this->assertInstanceOf(User::class, $prize->winners()->find($winner->id));

        // set manual winner for Second prize
        $prize2 = Prize::find(2);
        $ticket2 = DrawTicket::all()->random();

        // The same user cannot win other prizes
        $winner = $prize2->give($ticket->user, $ticket->ticket_number);
        $this->assertFalse($winner);

        $winner2 = $prize2->give($ticket2->user, $ticket2->ticket_number);
        $this->assertInstanceOf(User::class, $prize2->winners()->find($winner2->id));
    }
}

<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Prize;
use App\Models\DrawTicket;
use App\User;

class PrizesUnitTest extends TestCase
{
    use RefreshDatabase;

    public function testHasWinners()
    {
        $prize = Prize::first();
        $user = factory(User::class)->create();
        $winningTicket = factory(DrawTicket::class)->make();
        $user->tickets()->save($winningTicket);
        $prize->give($user, $winningTicket->ticket_number);

        $this->assertInstanceOf(User::class, $prize->winners()->first());
        $this->assertInstanceOf(Prize::class, $prize->winners()->find($user->id)->prize->details);
        // $this->assertInstanceOf(Prize::class, $prize->users()->first()->prize);
    }

    public function testCanWinOnePrizeOnly()
    {
        $winningTicket = factory(DrawTicket::class)->make();
        $winningTicket2 = factory(DrawTicket::class)->make();

        $prize1 = Prize::first();
        $prize2 = Prize::find(2);
        $user = factory(User::class)->create();
        $user->tickets()->save($winningTicket);
        $user->tickets()->save($winningTicket2);

        $this->assertTrue($prize1->give($user, $winningTicket->ticket_number));
        $this->assertFalse($prize2->give($user, $winningTicket2->ticket_number));
    }
}

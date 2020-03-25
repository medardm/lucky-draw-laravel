<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Models\Prize;
use App\Models\PrizeUser;
use App\Models\DrawTicket;
use App\User;

class PrizesTest extends TestCase
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

        $this->assertInstanceOf(User::class, $prize1->give($user, $winningTicket->ticket_number));
        $this->assertFalse($prize2->give($user, $winningTicket2->ticket_number));
    }

    public function testGetAvailablePrizes()
    {
        $winningTicket = factory(DrawTicket::class)->make();
        $winningTicket2 = factory(DrawTicket::class)->make();

        $prize2 = Prize::find(2);
        $user = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $user->tickets()->save($winningTicket);
        $user2->tickets()->save($winningTicket2);

        $prize2->give($user, $winningTicket->ticket_number);
        $prize2->give($user2, $winningTicket2->ticket_number);

        $this->assertEquals($prize2->winners->count(), $prize2->num_of_winners);
        $this->assertTrue(!Prize::available()->get()->contains($prize2));
    }
}

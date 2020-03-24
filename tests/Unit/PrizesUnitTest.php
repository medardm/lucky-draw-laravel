<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Models\Prize;
use App\Models\PrizeUser;
use App\User;

class PrizesUnitTest extends TestCase
{
    use RefreshDatabase;

    public function testHasWinners()
    {
        $prize = Prize::first();
        $user = factory(User::class)->create();
        $prize->give($user);

        $this->assertInstanceOf(User::class, $prize->winners()->first());
        $this->assertInstanceOf(Prize::class, $prize->winners()->find($user->id)->prize->details);
        // $this->assertInstanceOf(Prize::class, $prize->users()->first()->prize);
    }

    public function testCanWinOnePrizeOnly()
    {
        $prize1 = Prize::first();
        $prize2 = Prize::find(2);
        $user = factory(User::class)->create();

        $this->assertTrue($prize1->give($user));
        $this->assertFalse($prize2->give($user));
    }

    public function testGetAvailablePrizes()
    {
        $prize2 = Prize::find(2);
        $user = factory(User::class)->create();
        $user2 = factory(User::class)->create();
        $prize2->give($user);
        $prize2->give($user2);

        $this->assertEquals($prize2->winners->count(), $prize2->num_of_winners);
        $this->assertTrue(!Prize::available()->get()->contains($prize2));
    }
}

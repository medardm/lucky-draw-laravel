<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Prize;
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
}

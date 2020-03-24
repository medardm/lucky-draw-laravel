<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Models\User\Role;
use App\Models\DrawTicket;

class UserUnitTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test if user has role
     *
     * @return void
     */
    public function testHasRole()
    {
        $user = factory(User::class)->create();
        $this->assertInstanceOf(Role::class, $user->role);
    }

    public function testHasTickets()
    {
        $user = factory(User::class)->create();
        $user->tickets()->createMany(
            factory(DrawTicket::class, 3)->make(['user_id' => $user->id])->toArray()
        );
        $this->assertInstanceOf(DrawTicket::class, $user->tickets->first());
    }
}

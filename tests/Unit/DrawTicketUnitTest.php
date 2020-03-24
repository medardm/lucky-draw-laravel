<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Models\DrawTicket;

class DrawTicketUnitTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testBelongsToUser()
    {
        $ticket = factory(DrawTicket::class)->create();
        $this->assertInstanceOf(User::class, $ticket->user);
    }
}

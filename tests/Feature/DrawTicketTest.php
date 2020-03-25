<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Models\PrizeUser;
use App\Models\DrawTicket;

class DrawTicketTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic Feature test example.
     *
     * @return void
     */
    public function testBelongsToUser()
    {
        $ticket = factory(DrawTicket::class)->create();
        $this->assertInstanceOf(User::class, $ticket->user);
    }

    public function testGenerateTicket()
    {
        $randomTicket = factory(DrawTicket::class)->create(['ticket_number' => '']);
        $this->assertIsInt($randomTicket->ticket_number);

        $ticketNumber = 2124;
        $customTicket = factory(DrawTicket::class)->create(['ticket_number' => $ticketNumber]);
        $this->assertEquals($ticketNumber, $customTicket->ticket_number);
    }

    public function testTicketIsUnique()
    {
        $ticketNumber = 2124;
        $customTicket = factory(DrawTicket::class)->create(['ticket_number' => $ticketNumber]);
        $this->assertEquals($ticketNumber, $customTicket->ticket_number);

        // generate ticket if entered ticket is duplicate (only for this test)
        $customTicket2 = factory(DrawTicket::class)->create(['ticket_number' => $ticketNumber]);
        $this->assertNotEquals($ticketNumber, $customTicket2->ticket_number);
    }
}

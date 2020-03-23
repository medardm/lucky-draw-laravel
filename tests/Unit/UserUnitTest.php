<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Models\User\Role;

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
}

<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\User;
use App\Models\User\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleUnitTest extends TestCase
{
    use RefreshDatabase;

    public function testHasManyUsers()
    {
        $role = Role::first();
        $user = factory(User::class)->create([
            'role_id' => $role->id
        ]);
        $this->assertInstanceOf(User::class, $role->users->find($user->id));
    }
    
    public function testIsAdmin()
    {
        $user = factory(User::class)->create([
            'role_id' => Role::ADMIN
        ]);
        $this->assertTrue($user->isAdmin);
    }

    public function testIsMember()
    {
        $user = factory(User::class)->create([
            'role_id' => Role::ADMIN
        ]);
        $this->assertTrue($user->isAdmin);
    }
}

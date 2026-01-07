<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Role;

class AdminUserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_admin_can_create_user_and_assign_role()
    {
        $admin = User::whereHas('roles', fn($q) => $q->where('name','admin'))->first();
        $this->actingAs($admin)
            ->post(route('admin.users.store'), [
                'name' => 'New User',
                'email' => 'newuser@example.test',
                'role' => 'operator',
                'password' => 'secret123'
            ])
            ->assertRedirect(route('admin.users.index'));

        $this->assertDatabaseHas('users', ['email' => 'newuser@example.test']);
        $user = User::where('email','newuser@example.test')->first();
        $this->assertTrue($user->hasRole('operator'));
    }

    public function test_admin_can_reset_password()
    {
        $admin = User::whereHas('roles', fn($q) => $q->where('name','admin'))->first();
        $operator = User::whereHas('roles', fn($q) => $q->where('name','operator'))->first();

        $this->actingAs($admin)
            ->post(route('admin.users.reset', $operator), ['password' => 'newpass123'])
            ->assertRedirect(route('admin.users.index'));

        $operator->refresh();
        $this->assertTrue(password_verify('newpass123', $operator->password));
    }
}

<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_student_cannot_access_the_admin_panel(): void
    {
        Role::firstOrCreate(['name' => 'student']);
        $user = User::factory()->create();
        $user->assignRole('student');

        $this->actingAs($user)->get('/admin')->assertForbidden();
    }

    public function test_an_admin_can_access_the_admin_panel(): void
    {
        Role::firstOrCreate(['name' => 'admin']);
        $user = User::factory()->create();
        $user->assignRole('admin');

        $this->actingAs($user)->get('/admin')->assertOk();
    }

    public function test_a_guest_is_redirected_to_login(): void
    {
        $this->get('/admin')->assertRedirect('/login');
    }
}

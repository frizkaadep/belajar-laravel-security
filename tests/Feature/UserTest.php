<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

use function PHPUnit\Framework\assertTrue;

class UserTest extends TestCase
{
    public function testAuth()
    {
        $this->seed(UserSeeder::class);

        $success = Auth::attempt([
            "email" => "frizka@localhost",
            "password" => "rahasia1234"
        ], true);

        self::assertTrue($success);

        $user = Auth::user();
        self::assertNotNull($user);
        self::assertEquals("frizka@localhost", $user->email);
    }

    public function testGuest()
    {
        $user = Auth::user();
        self::assertNull($user);
    }

    public function testLogin()
    {
        $this->seed(UserSeeder::class);

        $this->get('/users/login?email=frizka@localhost&password=rahasia1234')
            ->assertRedirect("users/current");

        $this->get('/users/login?email=wrong&password=wrong')
            ->assertSeeText("Wrong credentials");
    }

    public function testCurrent()
    {
        $this->seed(UserSeeder::class);

        $this->get('/users/current')
            ->assertStatus(302) // redirect
            ->assertRedirect("/login");

        $user = User::where("email", "frizka@localhost")->firstOrFail();
        // actingAs di gunakan untuk meregistrasikan user ke session
        $this->actingAs($user)
            ->get('users/current')
            ->assertSeeText("Hello Frizka Ade");
    }

    public function testTokenGuard()
    {
        $this->seed(UserSeeder::class);

        $this->get('/api/users/current', [
            "Accept" => "application/json",
        ])
            ->assertStatus(401);

        $this->get('/api/users/current', [
            "Accept" => "application/json",
            "API-Key" => "secret"
        ])
            ->assertSeeText("Hello Frizka Ade");
    }

    public function testUserProvider()
    {
        $this->seed(UserSeeder::class);

        $this->get('/simple-api/users/current', [
            "Accept" => "application/json",
        ])
            ->assertStatus(401);

        $this->get('/simple-api/users/current', [
            "Accept" => "application/json",
            "API-Key" => "secret"
        ])
            ->assertSeeText("Hello Frizka Ade");
    }
}

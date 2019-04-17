<?php

namespace Tests\Feature;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DashboardTest extends TestCase
{
    /** @test */
    public function it_shows_the_dashboard_page_to_authenticated_users()
    {
       $user = factory(User::class)->create();
       $this->actingAs($user)
       ->get(route('home'))
       ->assertSee('Dashboard')
       ->assertStatus(200);
    }
}

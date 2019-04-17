<?php

namespace Tests\Feature\Agent;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AgentDashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function agents_can_visit_the_agent_dashboard()
    {   
        $agent = factory(User::class)->create([ 'agent' => true ]);
        $this->actingAs($agent)
            ->get(route('agent_dashboard'))
            ->assertStatus(200)
            ->assertSee('Agente Panel');
    }

    /** @test */
    function non_agents_cannot_visit_the_agent_dashboard()
    {   
        $user = factory(User::class)->create([ 'agent' => false ]);
        $this->actingAs($user)
            ->get(route('agent_dashboard'))
            ->assertStatus(403);
    }

    /** @test */
    function  guests_cannot_visit_the_agent_dashboard()
    {   
        $this->get(route('agent_dashboard'))
            ->assertStatus(302)
            ->assertRedirect('login');
    }
}

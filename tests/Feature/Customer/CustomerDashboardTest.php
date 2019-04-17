<?php

namespace Tests\Feature\Customer;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerDashboardTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function customers_can_visit_the_customer_dashboard()
    {   
        $customer = factory(User::class)->create([ 'customer' => true ]);
        $this->actingAs($customer)
            ->get(route('customer_dashboard'))
            ->assertStatus(200)
            ->assertSee('Cliente Panel');
    }

    /** @test */
    function non_customers_cannot_visit_the_customer_dashboard()
    {   
        $user = factory(User::class)->create([ 'customer' => false ]);
        $this->actingAs($user)
            ->get(route('customer_dashboard'))
            ->assertStatus(403);
    }

    /** @test */
    function  guests_cannot_visit_the_customer_dashboard()
    {   
        $this->get(route('customer_dashboard'))
            ->assertStatus(302)
            ->assertRedirect('login');
    }
}

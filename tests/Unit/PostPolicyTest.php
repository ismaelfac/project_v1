<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\{ User, Post };
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostPolicyTest extends TestCase
{
    /** @test */
    function admins_can_update_post()
    {
        //Arrange
        $admin = $this->createAdmin();

        $this->be($admin);

        $post = new Post;

        // Act
        $result = $admin->can('update-post', $post);

        // Assert
        $this->assertTrue($result);
    }

    /** @test */
    function authors_can_update_posts()
    {
        //Arrange
        $user = $this->createUser();

        $this->be($user);

        $post = factory(Post::class)->create(['user_id' => $user->id]);

        // Act
        $result = $admin->can('update-post', $post);

        // Assert
        $this->assertTrue($result);
    }

    /** @test */
    function guests_cannot_update_post()
    {
        //Arrange
        $post = new Post;

        // Act
        $result = Gate::allows('update-post', $post);

        // Assert
        $this->assertFalse($result);
    }
}


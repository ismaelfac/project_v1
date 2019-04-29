<?php

namespace Tests\Feature;
use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdatePostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function adminsCanUpdatePosts()
    {
        $this->withoutExceptionHandling();
        $post = factory(Post::class)->create();
        $admin = $this->createAdmin();
        $this->be($admin);
        $response = $this->put("admin/posts/{$post->id}", [
            'title' => 'Updated post title',
        ]);
        $response->assertStatus(200)
            ->assertSee('Post updated!');
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'Updated post title',
        ]);
    }
}

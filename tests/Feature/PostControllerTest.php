<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Post;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;

class PostControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        // Start a session to use CSRF token
        Session::start();
    }

    /** @test */
    public function it_can_display_posts()
    {
        Post::factory()->count(10)->create();

        $response = $this->get(route('posts.index'));

        $response->assertStatus(200);
        $response->assertViewHas('posts');
    }

    /** @test */
    public function it_can_create_a_post()
    {
        $postData = [
            'title' => 'Test Title',
            'content' => 'Test content for the post.',
            '_token' => csrf_token()
        ];

        $response = $this->post(route('posts.store'), $postData);

        $response->assertRedirect(route('posts.index'));
        $this->assertDatabaseHas('posts', [
            'title' => 'Test Title',
            'content' => 'Test content for the post.'
        ]);
    }

    /** @test */
    public function it_can_show_a_post()
    {
        $post = Post::factory()->create();

        $response = $this->get(route('posts.show', $post->id));

        $response->assertStatus(200);
        $response->assertViewHas('post', $post);
    }

    /** @test */
    public function it_can_update_a_post()
    {
        $post = Post::factory()->create();

        $updatedData = [
            'title' => 'Updated Title',
            'content' => 'Updated content for the post.',
            '_token' => csrf_token()
        ];

        $response = $this->put(route('posts.update', $post->id), $updatedData);

        $response->assertRedirect(route('posts.index'));
        $this->assertDatabaseHas('posts', [
            'title' => 'Updated Title',
            'content' => 'Updated content for the post.'
        ]);
    }

    /** @test */
    public function it_can_delete_a_post()
    {
        $post = Post::factory()->create();

        $response = $this->delete(route('posts.destroy', $post->id), [
            '_token' => csrf_token()
        ]);

        $response->assertRedirect(route('posts.index'));
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
}

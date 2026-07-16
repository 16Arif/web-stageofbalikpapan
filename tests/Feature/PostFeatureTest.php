<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_activity_page_can_be_accessed(): void
    {
        $response = $this->get('/activity');
        $response->assertStatus(200);
    }

    public function test_activity_page_only_shows_published_posts(): void
    {
        $published = Post::factory()->create(['status' => 'published', 'published_at' => now()->subDay()]);
        $draft = Post::factory()->create(['status' => 'draft', 'published_at' => null]);
        $scheduled = Post::factory()->create(['status' => 'scheduled', 'published_at' => now()->addDay()]);

        $response = $this->get('/activity');

        $response->assertSee($published->title);
        $response->assertDontSee($draft->title);
        $response->assertDontSee($scheduled->title);
    }

    public function test_category_filter_works(): void
    {
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();

        $post1 = Post::factory()->create(['status' => 'published', 'published_at' => now()->subDay(), 'category_id' => $category1->id]);
        $post2 = Post::factory()->create(['status' => 'published', 'published_at' => now()->subDay(), 'category_id' => $category2->id]);

        $response = $this->get('/activity?category=' . $category1->slug);

        $response->assertSee($post1->title);
        $response->assertDontSee($post2->title);
    }

    public function test_author_page_works(): void
    {
        $author = Author::factory()->create();
        $post = Post::factory()->create(['status' => 'published', 'published_at' => now()->subDay(), 'author_id' => $author->id]);

        $response = $this->get('/activity/author/' . $author->slug);
        $response->assertStatus(200);
        $response->assertSee($post->title);
    }

    public function test_detail_post_published_can_be_accessed(): void
    {
        $this->withoutExceptionHandling();
        $post = Post::factory()->create(['status' => 'published', 'published_at' => now()->subDay()]);
        $response = $this->get('/activity/' . $post->slug);
        $response->assertStatus(200);
        $response->assertSee($post->title);
    }

    public function test_detail_post_draft_returns_404(): void
    {
        $post = Post::factory()->create(['status' => 'draft', 'published_at' => null]);
        $response = $this->get('/activity/' . $post->slug);
        $response->assertStatus(404);
    }

    public function test_detail_post_scheduled_returns_404(): void
    {
        $post = Post::factory()->create(['status' => 'scheduled', 'published_at' => now()->addDay()]);
        $response = $this->get('/activity/' . $post->slug);
        $response->assertStatus(404);
    }

    public function test_pagination_works(): void
    {
        Post::factory(10)->create(['status' => 'published', 'published_at' => now()->subDay()]);

        $response = $this->get('/activity');
        $response->assertStatus(200);
        
        // Default pagination is 9 items per page.
        // The 10th item should be on page 2.
        $posts = Post::published()->latestPublished()->get();
        
        $response->assertSee($posts[0]->title);
        $response->assertDontSee($posts[9]->title);

        $responsePage2 = $this->get('/activity?page=2');
        $responsePage2->assertStatus(200);
        $responsePage2->assertSee($posts[9]->title);
        $responsePage2->assertDontSee($posts[0]->title);
    }

    public function test_homepage_shows_latest_published_posts(): void
    {
        $published = Post::factory()->create(['status' => 'published', 'published_at' => now()->subDay()]);
        $draft = Post::factory()->create(['status' => 'draft', 'published_at' => null]);

        $response = $this->get('/');
        $response->assertSee($published->title);
        $response->assertDontSee($draft->title);
    }
}

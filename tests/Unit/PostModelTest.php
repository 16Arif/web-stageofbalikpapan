<?php

namespace Tests\Unit;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostModelTest extends TestCase
{
    use RefreshDatabase;

    public function test_scope_published_only_returns_valid_published_posts(): void
    {
        $published = Post::factory()->create(['status' => 'published', 'published_at' => now()->subDay()]);
        $draft = Post::factory()->create(['status' => 'draft', 'published_at' => null]);
        $scheduled = Post::factory()->create(['status' => 'scheduled', 'published_at' => now()->addDay()]);
        $invalidPublished = Post::factory()->create(['status' => 'published', 'published_at' => now()->addDay()]);

        $publishedPosts = Post::published()->get();

        $this->assertTrue($publishedPosts->contains($published));
        $this->assertFalse($publishedPosts->contains($draft));
        $this->assertFalse($publishedPosts->contains($scheduled));
        $this->assertFalse($publishedPosts->contains($invalidPublished));
    }

    public function test_is_published_method_logic(): void
    {
        $published = new Post(['status' => 'published', 'published_at' => now()->subDay()]);
        $this->assertTrue($published->isPublished());

        $draft = new Post(['status' => 'draft', 'published_at' => null]);
        $this->assertFalse($draft->isPublished());

        $scheduled = new Post(['status' => 'scheduled', 'published_at' => now()->addDay()]);
        $this->assertFalse($scheduled->isPublished());

        $invalidPublished = new Post(['status' => 'published', 'published_at' => now()->addDay()]);
        $this->assertFalse($invalidPublished->isPublished());
    }

    public function test_image_url_provides_fallback(): void
    {
        $postWithoutImage = new Post(['featured_image' => null, 'img' => null]);
        $this->assertEquals(asset('favicon.ico'), $postWithoutImage->image_url);

        $postWithAbsoluteImage = new Post(['img' => 'https://example.com/image.jpg']);
        $this->assertEquals('https://example.com/image.jpg', $postWithAbsoluteImage->image_url);
        
        $postWithRelativeImage = new Post(['img' => '/images/test.jpg']);
        $this->assertEquals(asset('images/test.jpg'), $postWithRelativeImage->image_url);
    }
}

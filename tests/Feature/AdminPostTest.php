<?php

namespace Tests\Feature;

use App\Filament\Resources\Posts\Pages\CreatePost;
use App\Models\Author;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminPostTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_post_draft(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $category = Category::factory()->create();
        $author = Author::factory()->create();

        Livewire::test(CreatePost::class)
            ->set('data.title', 'Test Draft Post')
            ->set('data.slug', 'test-draft-post')
            ->set('data.excerpt', 'This is excerpt')
            ->set('data.content', 'This is content')
            ->set('data.category_id', $category->id)
            ->set('data.author_id', $author->id)
            ->set('data.status', 'draft')
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('posts', [
            'slug' => 'test-draft-post',
            'status' => 'draft',
        ]);
    }

    public function test_admin_can_publish_post(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $category = Category::factory()->create();
        $author = Author::factory()->create();

        Livewire::test(CreatePost::class)
            ->set('data.title', 'Test Published Post')
            ->set('data.slug', 'test-published-post')
            ->set('data.excerpt', 'This is excerpt')
            ->set('data.content', 'This is content')
            ->set('data.category_id', $category->id)
            ->set('data.author_id', $author->id)
            ->set('data.status', 'published')
            ->set('data.published_at', now()->format('Y-m-d H:i:s'))
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('posts', [
            'slug' => 'test-published-post',
            'status' => 'published',
        ]);
    }

    public function test_slug_duplicate_is_rejected(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Post::factory()->create(['slug' => 'duplicate-slug']);

        $category = Category::factory()->create();
        $author = Author::factory()->create();

        Livewire::test(CreatePost::class)
            ->set('data.title', 'Another Post')
            ->set('data.slug', 'duplicate-slug')
            ->set('data.excerpt', 'This is excerpt')
            ->set('data.content', 'This is content')
            ->set('data.category_id', $category->id)
            ->set('data.author_id', $author->id)
            ->set('data.status', 'draft')
            ->call('create')
            ->assertHasFormErrors(['slug' => 'unique']);
    }

    public function test_published_post_without_category_or_author_is_rejected(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Livewire::test(CreatePost::class)
            ->set('data.title', 'Test Published Post')
            ->set('data.slug', 'test-published-post-2')
            ->set('data.excerpt', 'This is excerpt')
            ->set('data.content', 'This is content')
            ->set('data.status', 'published')
            ->set('data.published_at', now()->format('Y-m-d H:i:s'))
            ->call('create')
            ->assertHasFormErrors(['category_id' => 'required', 'author_id' => 'required']);
    }
}

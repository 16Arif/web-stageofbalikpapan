<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('status')->default('draft')->after('slug');
            $table->string('featured_image')->nullable()->after('img');
            $table->string('meta_title')->nullable()->after('content');
            $table->text('meta_description')->nullable()->after('meta_title');
            $table->dateTime('published_at')->nullable()->change();

            $table->index('status');
            $table->index('published_at');
            $table->index('category_id');
            $table->index('author_id');
            $table->index(['status', 'published_at']);
        });

        DB::table('posts')
            ->whereNull('featured_image')
            ->whereNotNull('img')
            ->update(['featured_image' => DB::raw('img')]);
    }

    public function down(): void
    {
        DB::table('posts')
            ->whereNull('published_at')
            ->update(['published_at' => DB::raw('created_at')]);

        Schema::table('posts', function (Blueprint $table) {
            $table->dropIndex(['status', 'published_at']);
            $table->dropIndex(['author_id']);
            $table->dropIndex(['category_id']);
            $table->dropIndex(['published_at']);
            $table->dropIndex(['status']);

            $table->dateTime('published_at')->nullable(false)->change();
            $table->dropColumn([
                'status',
                'featured_image',
                'meta_title',
                'meta_description',
            ]);
        });
    }
};

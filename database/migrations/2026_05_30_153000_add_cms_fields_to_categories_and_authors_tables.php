<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->text('description')->nullable()->after('slug');
        });

        Schema::table('authors', function (Blueprint $table) {
            $table->text('bio')->nullable()->after('slug');
            $table->string('photo')->nullable()->after('bio');
        });
    }

    public function down(): void
    {
        Schema::table('authors', function (Blueprint $table) {
            $table->dropColumn(['bio', 'photo']);
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
};

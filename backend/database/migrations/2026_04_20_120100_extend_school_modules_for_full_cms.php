<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->foreignId('post_category_id')->nullable()->after('type')->constrained('post_categories')->nullOnDelete();
            $table->string('featured_image_path')->nullable()->after('content');
            $table->boolean('is_featured')->default(false)->after('featured_image_path');
            $table->boolean('show_in_slider')->default(false)->after('is_featured');
        });

        Schema::table('banners', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title');
            $table->boolean('is_active')->default(true)->after('status');
            $table->unsignedInteger('sort_order')->default(0)->after('is_active');
        });

        Schema::table('extracurriculars', function (Blueprint $table) {
            $table->string('featured_image_path')->nullable()->after('cover_image');
            $table->boolean('is_featured')->default(false)->after('status');
        });

        Schema::table('gallery_albums', function (Blueprint $table) {
            $table->string('cover_image_path')->nullable()->after('description');
            $table->boolean('is_featured')->default(false)->after('status');
        });

        Schema::table('site_settings', function (Blueprint $table) {
            $table->index(['group', 'key']);
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table) {
            $table->dropIndex(['group', 'key']);
        });

        Schema::table('gallery_albums', function (Blueprint $table) {
            $table->dropColumn(['cover_image_path', 'is_featured']);
        });

        Schema::table('extracurriculars', function (Blueprint $table) {
            $table->dropColumn(['featured_image_path', 'is_featured']);
        });

        Schema::table('banners', function (Blueprint $table) {
            $table->dropColumn(['slug', 'is_active', 'sort_order']);
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropConstrainedForeignId('post_category_id');
            $table->dropColumn(['featured_image_path', 'is_featured', 'show_in_slider']);
        });
    }
};


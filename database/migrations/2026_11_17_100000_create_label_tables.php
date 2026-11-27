<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('concept');
            $table->string('genre');
            $table->text('summary');
            $table->string('accent', 7);
            $table->string('accent_ink', 7);
            $table->string('telegram_url');
            $table->unsignedTinyInteger('sort_order');
            $table->timestamps();
        });

        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('bio')->nullable();
            $table->unsignedTinyInteger('sort_order');
            $table->timestamps();
        });

        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('listen_url');
            $table->text('description');
            $table->string('songwriter')->nullable();
            $table->string('producer')->nullable();
            $table->string('recording')->nullable();
            $table->date('released_on');
            $table->boolean('is_highlight')->default(false);
            $table->unsignedTinyInteger('highlight_position')->nullable();
            $table->unsignedTinyInteger('sort_order');
            $table->timestamps();
        });

        Schema::create('founders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role');
            $table->text('bio');
            $table->unsignedTinyInteger('sort_order');
            $table->timestamps();
        });

        Schema::create('news_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category');
            $table->text('excerpt');
            $table->text('body');
            $table->string('youtube_url')->nullable();
            $table->timestamp('published_at');
            $table->timestamps();
        });

        Schema::create('member_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('group_name');
            $table->text('quote');
            $table->timestamps();
        });

        Schema::create('audition_applications', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->unsignedTinyInteger('age')->nullable();
            $table->string('city');
            $table->string('contact');
            $table->string('email')->nullable();
            $table->string('interest');
            $table->string('experience');
            $table->text('why');
            $table->string('demo_url')->nullable();
            $table->string('status')->default('new')->index();
            $table->timestamps();
        });

        Schema::create('partnership_inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('organization')->nullable();
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('service');
            $table->text('message');
            $table->string('status')->default('new')->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partnership_inquiries');
        Schema::dropIfExists('audition_applications');
        Schema::dropIfExists('member_reviews');
        Schema::dropIfExists('news_posts');
        Schema::dropIfExists('songs');
        Schema::dropIfExists('members');
        Schema::dropIfExists('founders');
        Schema::dropIfExists('groups');
    }
};

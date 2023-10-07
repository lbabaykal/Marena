<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('image')->default('no_image.png');
            $table->string('title_orig');
            $table->string('title_rus');
            $table->string('title_eng');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('studio_id');
            $table->unsignedBigInteger('country_id');
//            $table->unsignedBigInteger('genre_id')->nullable();
//            $table->index('genre_id', 'article_genre_idx');
//            $table->foreign('genre_id', 'article_genre_fk')
//                            ->on('genres')
//                            ->references('id');
            $table->foreignIdFor(\App\Models\Genre::class)->nullable()->constrained();
            $table->string('episodes')->nullable();
            $table->string('year')->nullable();
            $table->string('age_limit')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('author_id');
            $table->boolean('is_show')->default(false);
            $table->boolean('is_comment')->default(false);
            $table->boolean('is_rating')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};

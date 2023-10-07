<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('article_genre', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Article::class)->constrained();
            $table->foreignIdFor(\App\Models\Genre::class)->constrained();
//            $table->unsignedBigInteger('article_id');
//            $table->unsignedBigInteger('genre_id');
//
//            $table->index('article_id', 'article_genre_article_idx');
//            $table->index('genre_id', 'article_genre_genre_idx');
//
//            $table->foreign('article_id', 'article_genre_article_fk')
//                ->on('articles')
//                ->references('id');
//            $table->foreign('genre_id', 'article_genre_genre_fk')
//                ->on('genres')
//                ->references('id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('article_genre');
    }
};

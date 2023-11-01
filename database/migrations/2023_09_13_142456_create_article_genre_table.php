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
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('article_genre');
    }
};

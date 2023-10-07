<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->index()->constrained('articles');
            $table->unsignedFloat('rating');
            $table->unsignedInteger('count_assessments');
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
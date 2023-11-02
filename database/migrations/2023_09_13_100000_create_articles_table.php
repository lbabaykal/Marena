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
            $table->foreignIdFor(\App\Models\Category::class)->constrained();
            $table->foreignIdFor(\App\Models\Type::class)->constrained();
            $table->foreignIdFor(\App\Models\Studio::class)->constrained();
            $table->foreignIdFor(\App\Models\Country::class)->constrained();
            $table->foreignIdFor(\App\Models\Genre::class)->nullable()->constrained();
            $table->string('episodes')->nullable();
            $table->date('release');
            $table->string('age_limit')->nullable();
            $table->text('description')->nullable();
            $table->foreignIdFor(\App\Models\User::class, 'author_id')->constrained('users');
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

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
            $table->string('image')->nullable();
            $table->string('title_orig');
            $table->string('title_rus');
            $table->string('title_eng');
            $table->foreignIdFor(\App\Models\Category::class)->constrained();
            $table->foreignIdFor(\App\Models\Type::class)->constrained();
            $table->enum('age_limit', ['0+', '6+', '12+', '16+', '18+'])->default('18+');
            $table->foreignIdFor(\App\Models\Studio::class)->nullable()->constrained();
            $table->foreignIdFor(\App\Models\Country::class)->constrained();
            $table->foreignIdFor(\App\Models\Genre::class)->nullable()->constrained();
            $table->string('episodes')->nullable();
            $table->date('release');
            $table->text('description')->nullable();
            $table->foreignIdFor(\App\Models\User::class, 'author_id')->constrained('users');
            $table->enum('status', ['PUBLISHED', 'DRAFT', 'ARCHIVE', 'DELETED'])->default('DRAFT');
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

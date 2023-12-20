<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Playlist::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->unsignedSmallInteger('number');
            $table->string('title');
            $table->date('release');
            $table->enum('status', ['PUBLISHED', 'DRAFT', 'ERROR'])->default('DRAFT');
            $table->string('note');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('episodes');
    }
};

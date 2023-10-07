<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedTinyInteger('isAdmin')->default(0);
            $table->unsignedTinyInteger('allowView')->default(0);
            $table->unsignedTinyInteger('allowCreate')->default(0);
            $table->unsignedTinyInteger('allowUpdate')->default(0);
            $table->unsignedTinyInteger('allowDelete')->default(0);
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};

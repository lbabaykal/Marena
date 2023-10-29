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
            $table->boolean('isAdmin')->default(false);
            $table->boolean('allowView')->default(false);
            $table->boolean('allowCreate')->default(false);
            $table->boolean('allowUpdate')->default(false);
            $table->boolean('allowDelete')->default(false);
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};

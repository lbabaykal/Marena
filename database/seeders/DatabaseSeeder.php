<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            Countries::class,
            Categories::class,
            Folders::class,
            Types::class,
            Genres::class,
        ]);
    }
}

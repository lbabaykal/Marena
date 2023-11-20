<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Categories extends Seeder
{

    public function run(): void
    {
        \App\Models\Category::query()->insert(
            [
                ['title' => 'Аниме'],
                ['title' => 'Дорама'],
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgeLimit extends Seeder
{

    public function run(): void
    {
        \App\Models\AgeLimit::query()->insert(
            [
                ['title' => '0+'],
                ['title' => '6+'],
                ['title' => '12+'],
                ['title' => '16+'],
                ['title' => '18+'],
            ]
        );
    }
}

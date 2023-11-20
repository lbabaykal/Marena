<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Types extends Seeder
{

    public function run(): void
    {
        \App\Models\Type::query()->insert(
            [
                ['title' => 'TV'],
                ['title' => 'Film'],
                ['title' => 'Special'],
                ['title' => 'OVA'],
                ['title' => 'ONA'],
            ]
        );
    }
}

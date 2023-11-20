<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Countries extends Seeder
{

    public function run(): void
    {
        \App\Models\Country::query()->insert(
            [
                ['title' => 'Япония'],
                ['title' => 'Китай'],
                ['title' => 'Южная Корея'],
                ['title' => 'Таиланд'],
                ['title' => 'Гонконг'],
            ]
        );
    }
}

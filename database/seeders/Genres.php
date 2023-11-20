<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Genres extends Seeder
{

    public function run(): void
    {
        \App\Models\Genre::query()->insert(
            [
                ['title' => 'Боевые искусства'],
                ['title' => 'Детектив'],
                ['title' => 'Драма'],
                ['title' => 'Комедия'],
                ['title' => 'Махо-сёдзё'],
                ['title' => 'Меха'],
                ['title' => 'Мистика'],
                ['title' => 'Музыкальный'],
                ['title' => 'Образовательный'],
                ['title' => 'Повседневность'],
                ['title' => 'Приключения'],
                ['title' => 'Романтика'],
                ['title' => 'Сёнен'],
                ['title' => 'Сёдзё'],
                ['title' => 'Спорт'],
                ['title' => 'Триллер'],
                ['title' => 'Фантастика'],
                ['title' => 'Фэнтези'],
                ['title' => 'Этти'],
                ['title' => 'Ужасы'],
                ['title' => 'Мелодрама'],
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Folders extends Seeder
{

    public function run(): void
    {
        \App\Models\Folder::query()->insert(
            [
                [
                    'title' => 'Смотрю',
                    'user_id' => 0,
                    'isPublic' => false
                ],
                [
                    'title' => 'В планах',
                    'user_id' => 0,
                    'isPublic' => false
                ],
                [
                    'title' => 'Просмотрено',
                    'user_id' => 0,
                    'isPublic' => false
                ],
                [
                    'title' => 'Брошено',
                    'user_id' => 0,
                    'isPublic' => false
                ],
            ]
        );
    }
}

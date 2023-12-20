<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Studios extends Seeder
{

    public function run(): void
    {
        \App\Models\Studio::query()->insert(
            [
                ['title' => 'Bones'],
                ['title' => 'Studio Ghibli'],
                ['title' => 'Kyoto Animation'],
                ['title' => 'CoMix Wave Films'],
                ['title' => 'Artland'],
                ['title' => 'Madhouse'],
                ['title' => 'Gainax'],
                ['title' => 'A-1 Pictures'],
                ['title' => 'OLM'],
                ['title' => 'Manglobe'],
                ['title' => 'Daume'],
                ['title' => 'Studio Voln'],
                ['title' => 'Ufotable'],
                ['title' => 'Shuka'],
                ['title' => 'P.A. Works'],
                ['title' => 'tvN'],
                ['title' => 'JTBC'],
                ['title' => 'KBS2'],
                ['title' => 'Netflix'],
                ['title' => 'OCN'],
                ['title' => 'Channel A'],
                ['title' => 'MBC'],
                ['title' => 'SBS'],
                ['title' => 'J.C. Staff'],
                ['title' => 'Goldmoon Film'],
                ['title' => 'Youku'],
                ['title' => 'Tencent Video'],
            ]
        );
    }
}

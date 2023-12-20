<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Users extends Seeder
{

    public function run(): void
    {
        $user = \App\Models\User::query()->create([
            'avatar' => null,
            'username' => 'BaBaYKA',
            'email' => 'mei.babayka@gmail.com',
            'password' => Hash::make('q1w2e3r4t5y6'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $user->assignRole('Administrator');


        $user2 = \App\Models\User::query()->create([
            'avatar' => null,
            'username' => 'Misaki',
            'email' => 'misaki.babayka@gmail.com',
            'password' => Hash::make('q1w2e3r4t5y6'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $user2->assignRole('User');

        $user3 = \App\Models\User::query()->create([
            'avatar' => null,
            'username' => 'Aika',
            'email' => 'aika.babayka@gmail.com',
            'password' => Hash::make('q1w2e3r4t5y6'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $user3->assignRole('Moderator');
    }
}

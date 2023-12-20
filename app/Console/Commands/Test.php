<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class Test extends Command
{

    protected $signature = 'test';
    protected $description = 'test';

    public function handle()
    {

//        $user = User::query()->find(1);
//        $user->roles;
        $user = User::query()->find(1);
        dd($user->rolesRus->first());
//        echo 'Test';
    }
}

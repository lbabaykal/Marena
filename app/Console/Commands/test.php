<?php

namespace App\Console\Commands;

use App\Models\Folder;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;

class test extends Command
{

    protected $signature = 'test';
    protected $description = 'test';

    public function handle()
    {
//        $data = [
//            'article_id' => 1,
//            'user_id' => 1,
//        ];
//        $data2 = [
//            'status' => 4
//        ];
//        //Create or Update
//        $kek = Folder::updateOrCreate($data, $data2);

        //DELETE
//        $kek = Folder::where([
//            'article_id' => 1,
//            'user_id' => 1
//        ])->delete();

        $lol = User::query()->find(1)->folders();
        dd($lol);
        return 0;
    }
}

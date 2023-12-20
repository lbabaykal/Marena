<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Permissions extends Seeder
{

    public function run(): void
    {
        Permission::query()->create([
            'name' => 'Admin_Panel',
            'name_rus' => 'Админпанель',
            'guard_name' => 'web',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Permission::query()->create([
            'name' => 'Roles',
            'name_rus' => 'Роли',
            'guard_name' => 'web',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Permission::query()->create([
            'name' => 'Users',
            'name_rus' => 'Пользователи',
            'guard_name' => 'web',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

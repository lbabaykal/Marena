<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class Roles extends Seeder
{

    public function run(): void
    {
        $role1 = Role::query()->create([
            'name' => 'Administrator',
            'name_rus' => 'Администратор',
            'guard_name' => 'web',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $role1->givePermissionTo('Admin_Panel');
        $role1->givePermissionTo('Roles');
        $role1->givePermissionTo('Users');

        Role::query()->create([
            'name' => 'User',
            'guard_name' => 'web',
            'name_rus' => 'Пользователь',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $role3 = Role::query()->create([
            'name' => 'Moderator',
            'name_rus' => 'Модератор',
            'guard_name' => 'web',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $role3->givePermissionTo('Admin_Panel');

        $role4 = Role::query()->create([
            'name' => 'Editor',
            'name_rus' => 'Редактор',
            'guard_name' => 'web',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $role4->givePermissionTo('Admin_Panel');

        //========TEAM========
        Role::query()->create([
            'name' => 'Team leader',
            'name_rus' => 'Глава команды',
            'guard_name' => 'team',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Role::query()->create([
            'name' => 'Voiceover',
            'name_rus' => 'Озвучивающий',
            'guard_name' => 'team',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Role::query()->create([
            'name' => 'Technician',
            'name_rus' => 'Технарь',
            'guard_name' => 'team',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Role::query()->create([
            'name' => 'Translator',
            'name_rus' => 'Переводчик',
            'guard_name' => 'team',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Role::query()->create([
            'name' => 'Member',
            'name_rus' => 'Участник',
            'guard_name' => 'team',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

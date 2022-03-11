<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_permissions')->insert([
            'role' => 'admin',
            'route_name' => 'pages',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('user_permissions')->insert([
            'role' => 'admin',
            'route_name' => 'navigation-menus',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('user_permissions')->insert([
            'role' => 'admin',
            'route_name' => 'dashboard',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('user_permissions')->insert([
            'role' => 'admin',
            'route_name' => 'users',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('user_permissions')->insert([
            'role' => 'admin',
            'route_name' => 'user-permissions',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('user_permissions')->insert([
            'role' => 'admin',
            'route_name' => 'holidays',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('user_permissions')->insert([
            'role' => 'admin',
            'route_name' => 'holidays-overview',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('user_permissions')->insert([
            'role' => 'admin',
            'route_name' => 'roles',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('user_permissions')->insert([
            'role' => 'admin',
            'route_name' => 'workingdays',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('user_permissions')->insert([
            'role' => 'admin',
            'route_name' => 'clients',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('user_permissions')->insert([
            'role' => 'admin',
            'route_name' => 'vaults',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('user_permissions')->insert([
            'role' => 'admin',
            'route_name' => 'client-profile',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('user_permissions')->insert([
            'role' => 'admin',
            'route_name' => 'client-contacts',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('user_permissions')->insert([
            'role' => 'admin',
            'route_name' => 'message-centre',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('user_permissions')->insert([
            'role' => 'admin',
            'route_name' => 'users-trashed',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

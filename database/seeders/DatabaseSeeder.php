<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(NavigationMenuSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(WorkingDaysSeeder::class);
        $this->call(UserPermissionSeeder::class);
        $this->call(RoleUserSeeder::class);
    }
}

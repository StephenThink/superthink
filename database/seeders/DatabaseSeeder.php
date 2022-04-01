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
        $this->call(RoleUserSeeder::class);
        $this->call(BankHolidaySeeder::class);
        $this->call(ClientAddressSeeder::class);
        $this->call(ClientAddressTypeSeeder::class);
        $this->call(ClientPasswordSeeder::class);
        $this->call(ClientContactsSeeder::class);
        $this->call(ClientJobStatusSeeder::class);
        $this->call(ClientJobSeeder::class);
        // $this->call(JobStatusSeeder::class);
    }
}

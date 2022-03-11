<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NavigationMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('navigation_menus')->insert([
            'sequence' => '1',
            'type' => 'SidebarNav',
            'label' => 'Home',
            'slug' => 'home',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('navigation_menus')->insert([
            'sequence' => '2',
            'type' => 'SidebarNav',
            'label' => 'About',
            'slug' => 'about',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('navigation_menus')->insert([
            'sequence' => '3',
            'type' => 'SidebarNav',
            'label' => 'Contact',
            'slug' => 'contact',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('navigation_menus')->insert([
            'sequence' => '1',
            'type' => 'TopNav',
            'label' => 'Login',
            'slug' => 'login',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

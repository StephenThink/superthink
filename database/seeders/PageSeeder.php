<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            'is_default_home' => '1',
            'title' => 'Home',
            'slug' => 'home',
            'content' => '<div>The content of the home page!</div>',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('pages')->insert([
            'title' => 'About',
            'slug' => 'about',
            'content' => '<div>About Us</div>',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('pages')->insert([
            'title' => 'Contact',
            'slug' => 'contact',
            'content' => '<div>Contact Us</div>',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('pages')->insert([
            'is_default_not_found' => '1',
            'title' => 'Error 404',
            'slug' => 'error-404',
            'content' => '<div>There has been an error.</div>',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

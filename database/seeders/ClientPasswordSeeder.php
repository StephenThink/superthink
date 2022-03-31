<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientPasswordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vaults')->insert([
            'client_id' => '1',
            'title' => 'Superthink',
            'password' => encrypt("password"), // password
            'login' => 'stephen@thinkcreative.uk.com',
            'url' => 'http://superthink.test',
            'description' => 'Login Information for SuperThink',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('vaults')->insert([
            'client_id' => '1',
            'title' => 'Superthink',
            'password' => encrypt("password"), // password
            'login' => 'paul.sealey@thinkcreative.uk.com',
            'url' => 'http://superthink.test',
            'description' => 'Login Information for SuperThink',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('client_jobs')->insert([
            'client_id' => '1',
            'job_name' => 'SuperThink',
            'job_number' => 'TC1000-87',
            'budget' => '10000',
            'status_id' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('client_jobs')->insert([
            'client_id' => '1',
            'job_name' => 'Website',
            'job_number' => 'TC1000-12',
            'budget' => '5000',
            'status_id' => '2',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('client_jobs')->insert([
            'client_id' => '1',
            'job_name' => 'Old Website',
            'job_number' => 'TC1000-11',
            'budget' => '2000',
            'status_id' => '3',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('client_jobs')->insert([
            'client_id' => '1',
            'job_name' => 'Boom',
            'job_number' => 'TC1001-12',
            'budget' => '5000',
            'status_id' => '4',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

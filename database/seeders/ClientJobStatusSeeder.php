<?php

namespace Database\Seeders;


use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ClientJobStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('client_job_statuses')->insert([
            'name' => 'In Play',
            'icon' => 'play',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('client_job_statuses')->insert([
            'name' => 'Paused',
            'icon' => 'pause',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('client_job_statuses')->insert([
            'name' => 'Completed',
            'icon' => 'completed',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('client_job_statuses')->insert([
            'name' => 'Archived',
            'icon' => 'archived',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

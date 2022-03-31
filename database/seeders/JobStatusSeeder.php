<?php

namespace Database\Seeders;

use App\Models\ClientJob;
use App\Models\ClientJobStatus;
use Illuminate\Database\Seeder;

class JobStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $status = ClientJobStatus::all();

        ClientJob::all()->each(function ($job) use ($status) {
            $job->statuses()->attach(
                $status->pluck('id')->first()
            );
        });
    }
}

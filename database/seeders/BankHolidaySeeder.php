<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankHolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('bank_holidays')->insert([
            'description' => 'New Years Day',
            'bankdate' => '2022-01-03',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('bank_holidays')->insert([
            'description' => 'Good Friday',
            'bankdate' => '2022-04-15',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('bank_holidays')->insert([
            'description' => 'Easter Monday',
            'bankdate' => '2022-04-18',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('bank_holidays')->insert([
            'description' => 'Early May Bank Holiday',
            'bankdate' => '2022-05-02',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('bank_holidays')->insert([
            'description' => 'Spring Bank Holiday',
            'bankdate' => '2022-06-02',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('bank_holidays')->insert([
            'description' => 'Platinum Jubilee Bank Holiday',
            'bankdate' => '2022-06-03',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('bank_holidays')->insert([
            'description' => 'Summer Bank Holiday',
            'bankdate' => '2022-08-29',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('bank_holidays')->insert([
            'description' => 'Boxing Day',
            'bankdate' => '2022-12-26',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('bank_holidays')->insert([
            'description' => 'Christmas Day',
            'bankdate' => '2022-12-27',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

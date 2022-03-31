<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ClientAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('client_addresses')->insert([
            'client_id' => '1',
            'type' => '2',
            'property_name' => 'Think HQ',
            'property_number' => '32',
            'address_1' => 'Blackpool Road',
            'address_2' => '',
            'town_city' => 'Poulton-le-Fylde',
            'county' => 'Lancashire',
            'post_code' => 'FY6 7QA',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('client_addresses')->insert([
            'client_id' => '1',
            'type' => '1',
            'property_name' => 'Think HQ',
            'property_number' => '32',
            'address_1' => 'Blackpool Road',
            'address_2' => '',
            'town_city' => 'Poulton-le-Fylde',
            'county' => 'Lancashire',
            'post_code' => 'FY6 7QA',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('client_addresses')->insert([
            'client_id' => '1',
            'type' => '3',
            'property_name' => 'Think HQ',
            'property_number' => '32',
            'address_1' => 'Blackpool Road',
            'address_2' => '',
            'town_city' => 'Poulton-le-Fylde',
            'county' => 'Lancashire',
            'post_code' => 'FY6 7QA',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

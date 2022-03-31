<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('client_contacts')->insert([
            'client_id' => '1',
            'staff_name' => 'Stephen Jackson',
            'staff_position' => 'Web Developer',
            'staff_email' => 'stephen@thinkcreative.uk.com',
            'staff_number' => '01253297900',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('client_contacts')->insert([
            'client_id' => '1',
            'staff_name' => 'Paul Sealey',
            'staff_position' => 'Project Manager',
            'staff_email' => 'paul.sealey@thinkcreative.uk.com',
            'staff_number' => '01253297900',
            'staff_notes' => 'The other Paul.',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

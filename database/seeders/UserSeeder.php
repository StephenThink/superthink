<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::factory()->times(1)->create();

        DB::table('users')->insert([
            'name' => 'Stephen Jackson',
            'dateStarted' => Carbon::now()->toDateString(),
            'leaveDays' => '20',
            'email_verified_at' => Carbon::now(),
            'email' => 'stephen@thinkcreative.uk.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('teams')->insert([
            'user_id' => '1',
            'name' => 'Stephen\'s Team',
            'personal_team' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('users')->insert([
            'name' => 'Paul Sealey',
            'dateStarted' => Carbon::now()->toDateString(),
            'leaveDays' => '20',
            'email_verified_at' => Carbon::now(),
            'email' => 'paul.sealey@thinkcreative.uk.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        DB::table('teams')->insert([
            'user_id' => '2',
            'name' => 'Paul\'s Team',
            'personal_team' => '1',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}

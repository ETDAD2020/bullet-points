<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create([
          'name' => 'admin',
          'email' => 'admin@gmail.com',
          'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
          'role' => 'admin'
        ]);

        DB::table('plans')->insert([
            'type' => 'RECURRING',
            'name' => 'Test Plan',
            'price' => 5.00,
            'interval' => 'EVERY_30_DAYS',
            'capped_amount' => 10.00,
            'terms' => 'Test terms',
            'trial_days' => 7,
            'test' => FALSE,
            'on_install' => 1,
            'created_at' => NULL,
            'updated_at' => NULL
        ]);

    }
}

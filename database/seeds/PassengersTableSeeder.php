<?php

use Illuminate\Database\Seeder;

class PassengersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('passengers')->insert([
            'id' => 1,
            'name' => 'First User',
            'phone' => '918700693',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}

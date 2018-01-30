<?php

use Illuminate\Database\Seeder;

class ChangesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('changes')->insert([
            'itinerary_id' => 1,
            'outgoing_dep_time' => now(),
            'outgoing_arr_time' => now(),
            'return_dep_time' => now(),
            'return_arr_time' => now(),
            'comments' => 'Al doilea zbor din baza de date',
            'status' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}

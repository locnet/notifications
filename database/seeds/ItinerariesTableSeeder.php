<?php

use Illuminate\Database\Seeder;

class ItinerariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('itineraries')->insert([
            'title' => 'Vuelo cambiado',
            'carrier' => 'BlueAir',
            'departure_station' => 'Madrid',
            'arrival_station' => 'Bucuresti',
            'return' => true,
            'scale' => false,
            'outbound_dep_time' => now(),
            'outbound_arr_time'=> now(),
            'return_dep_time' => now(),
            'return_arr_time' => now(),
            'outbound_scale_start_time' => now(),
            'outbound_scale_end_time'=> now(),
            'return_scale_start_time' => now(),
            'return_scale_end_time' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}

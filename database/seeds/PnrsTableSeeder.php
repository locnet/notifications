<?php

use Illuminate\Database\Seeder;

class PnrsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pnrs')->insert([
            'pnr' => str_random(6),
            'itinerary_id' => 1,
            'user_id' => 1,
            'status' => 1,
            'comments' => 'Otro pnr afectado por un cambio',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}

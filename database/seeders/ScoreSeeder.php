<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScoreSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        if (!DB::table('scores')->first()) {
            DB::table('scores')->insert([
                ['score' => 1],
                ['score' => 2],
                ['score' => 3],
                ['score' => 4],
                ['score' => 5],
            ]);
        }
    }
}

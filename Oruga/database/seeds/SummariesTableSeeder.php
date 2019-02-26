<?php

use Illuminate\Database\Seeder;

class SummariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nums = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

        foreach($nums as $num) {
            DB::table('summaries')->insert([
                'word' => str_random(10),
                'genre' => str_random(10),
                'text' => str_random(100),
                'count' => $num,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]);
        }
    }
}

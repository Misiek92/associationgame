<?php

use Illuminate\Database\Seeder;
use App\Word;

class InitialWordsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        DB::table('words')->delete();
        
        DB::table('words')->insert(
                ['word' => 'test']
        );
    }

}

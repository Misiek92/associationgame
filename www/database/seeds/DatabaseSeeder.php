<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use InitialWordsSeeder;

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call('InitialWordsSeed');

        Model::reguard();
    }

}

<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class,3)->create()->each(function($u){
            $u->questions()
              ->saveMany(factory(App\Question::class, rand(3,10))->make()
            );
        });
        //factory(App\Question,3)->create(); cant call like that bcz each user may have one or more questions
    }
}

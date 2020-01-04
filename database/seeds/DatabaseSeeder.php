<?php

use App\Question;
use App\User;
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
        // $this->call(UsersTableSeeder::class);

        factory(User::class, 3)->create()->each(function ($userQuestion) {
            $userQuestion->questions()->saveMany(
                factory(Question::class, rand(1, 5))->make()
            );
        });
    }
}

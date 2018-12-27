<?php

use Illuminate\Database\Seeder;

class TeamsPlayersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Team::class, 5)->create()->each(function ($team) {
            for ($p=1; $p<=5; $p++) {
                $team->players()->save(factory(App\Player::class)->make());
            }
        });
    }
}

<?php

namespace App\Http\Controllers;


use App\Player;

class PlayerController extends Controller
{
    /**
     * Gets all the players along with their teams
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index() {
        $players = Player::query()->with('team')->get();

        return $players;
    }

    /**
     * Creates a new player
     *
     * @return mixed
     */
    public function create() {
        $player = Player::create(request()->all());

        return $player;
    }

    /**
     * Updates a player based on the id
     *
     * @param $playerId
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function update($playerId) {
        $player = Player::query()->find($playerId);

        $player->fill(request()->all());

        $player->save();

        return $player;
    }
}

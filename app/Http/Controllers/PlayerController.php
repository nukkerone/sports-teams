<?php

namespace App\Http\Controllers;


use App\Player;

class PlayerController extends Controller
{
    public function index() {
        $players = Player::query()->with('team')->get();

        return $players;
    }

    public function create() {
        $player = Player::create(request()->all());

        return $player;
    }

    public function update($id) {
        $player = Player::query()->find($id);

        $player->fill(request()->all());

        $player->save();

        return $player;
    }
}

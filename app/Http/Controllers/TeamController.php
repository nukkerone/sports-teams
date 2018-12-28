<?php

namespace App\Http\Controllers;


use App\Team;

class TeamController extends Controller
{
    public function index() {
        $teams = Team::query()->with('players')->get();

        return $teams;
    }

    public function get($id) {
        $team = Team::query()->with('players')->find($id);

        return $team;
    }

    public function create() {
        $team = Team::create(request()->all());

        return $team;
    }

    public function update($id) {
        $team = Team::query()->find($id);

        $team->fill(request()->all());

        $team->save();

        return $team;
    }

    public function delete($id) {
        $team = Team::query()->find($id);
        $team->delete();

        return Team::query()->with('players')->get();
    }

    public function getPlayers($id) {
        $team = Team::query()->find($id);

        return $team->players;
    }

    public function createPlayer($id) {
        $team = Team::query()->find($id);
        $player = $team->players()->create(request()->all());

        return $player;
    }

    public function updatePlayer($teamId, $playerId) {
        $team = Team::query()->find($teamId);
        $player = $team->players()->find($playerId);
        if ($player) {
            $player->fill(request()->all());
            $player->save();
        }
        return $player;
    }

    public function deletePlayer($teamId, $playerId) {
        $team = Team::query()->find($teamId);
        $player = $team->players()->find($playerId);
        if ($player)    $player->delete();
    }
}

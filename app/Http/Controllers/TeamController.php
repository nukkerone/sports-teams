<?php

namespace App\Http\Controllers;


use App\Player;
use App\Team;

class TeamController extends Controller
{
    /**
     * Gets all the teams with their players
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index() {
        $teams = Team::query()->with('players')->get();

        return $teams;
    }

    /**
     * Gets a single team based on the id
     *
     * @param $teamId
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function get($teamId) {
        $team = Team::query()->with('players.team')->find($id);

        return $team;
    }

    /**
     * Creates a new team
     *
     * @return mixed
     */
    public function create() {
        $team = Team::create(request()->all());

        return $team;
    }

    /**
     * Updates an existing team based on the id
     *
     * @param $teamId
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function update($teamId) {
        $team = Team::query()->find($teamId);

        $team->fill(request()->all());

        $team->save();

        return $team;
    }

    /**
     * Deletes a team based on the id
     *
     * @param $teamId
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     * @throws \Exception
     */
    public function delete($teamId) {
        $team = Team::query()->find($teamId);
        $team->delete();

        return Team::query()->with('players')->get();
    }

    /**
     * Gets the players from a team
     *
     * @param $teamId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getPlayers($teamId) {
        $players = Player::query()->with('team')->where('team_id', '=', $id);

        return $players;
    }

    /**
     * Creates a new player for the team
     *
     * @param $teamId
     * @return mixed
     */
    public function createPlayer($teamId) {
        $team = Team::query()->find($teamId);
        $player = $team->players()->create(request()->all());

        return $player;
    }

    /**
     * Updates a player from the team
     *
     * @param $teamId
     * @param $playerId
     * @return mixed
     */
    public function updatePlayer($teamId, $playerId) {
        $team = Team::query()->find($teamId);
        $player = $team->players()->find($playerId);
        if ($player) {
            $player->fill(request()->all());
            $player->save();
        }
        return $player;
    }

    /**
     * Deletes a player that's on the team
     *
     * @param $teamId
     * @param $playerId
     */
    public function deletePlayer($teamId, $playerId) {
        $team = Team::query()->find($teamId);
        $player = $team->players()->find($playerId);
        if ($player)    $player->delete();
    }
}

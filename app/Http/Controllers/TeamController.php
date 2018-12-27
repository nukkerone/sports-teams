<?php

namespace App\Http\Controllers;


use App\Team;

class TeamController extends Controller
{
    public function index() {
        $teams = Team::query()->with('players')->get();

        return $teams;
    }
}

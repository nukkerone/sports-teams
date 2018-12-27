<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $table = 'players';

    protected $fillable = ['name'];

    public function team() {
        return $this->belongsTo('App\Team', 'team_id', 'id');
    }
}

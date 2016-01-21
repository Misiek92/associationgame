<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{

    protected $table = 'games';
    protected $fillable = [
        'name', 'points_1', 'points_2', 'status'
    ];

    public function distribution()
    {
        return $this->belongsTo('App\Distribution');
    }
}

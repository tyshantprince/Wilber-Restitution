<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'body'
    ];


    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

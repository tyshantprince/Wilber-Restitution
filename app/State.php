<?php

namespace App;

use Iatstuti\Database\Support\OwnsModels;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use OwnsModels;

    protected $fillable = [
        'abbr', 'name', 'url',
    ];

    public function contacts()
    {
        return $this->hasManyThrough(Contact::class, County::class);
    }

    public function counties()
    {
        return $this->hasMany(County::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function addNote(array $data)
    {
        $note = new Note($data);

        $this->notes()->save($note);

        return $note;
    }

    public function addCounty(array $data)
    {
        $county = new County($data);
        $county->state_id = $this->id;
        $this->counties()->save($county);
        return $county;
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Mockery\Matcher\Not;

class State extends Model
{
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

    public function updateNote(Note $note, array $data)
    {
        dd($data);
        $note->body = $data;
        $note->save();
        return $note;
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    protected $table = 'counties';

    protected $fillable = [
        'state_id', 'name',
    ];


    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function addContact(array $data)
    {
        $contact = new Contact($data);
        $this->contacts()->save($contact);
        return $contact;
    }

}

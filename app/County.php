<?php

namespace App;

use Iatstuti\Database\Support\OwnsModels;
use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    use OwnsModels;

    protected $table = 'counties';

    protected $fillable = [
        'name',
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
//        $contact->user_id = auth()->id();
        $contact->user_id = 1;
        $this->contacts()->save($contact);
        return $contact;
    }

}

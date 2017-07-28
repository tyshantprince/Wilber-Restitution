<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'contact_name', 'phone', 'ext', 'address1', 'address2', 'city', 'zip', 'fax', 'email', 'website', 'fee', 'notes'
    ];


    public function county()
    {
        return $this->belongsTo(County::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}

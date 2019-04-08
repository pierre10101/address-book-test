<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    protected $guarded = [];

    protected $table = 'contacts';

    public function addresses(){
        return $this->hasMany('App\ContactAddresses');
    }
}

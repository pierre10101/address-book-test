<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactAddresses extends Model
{

    protected $table = 'contact_addresses';

    public function contacts(){
        return $this->belongsTo('App\Contacts');
    }

    public $fillable = ['contacts_id', 'email', 'contact_number'];
}

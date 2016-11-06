<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emails extends Model
{
    protected $fillable = [
    	'email_user','email_domain','email_password','email_quota','created_by','created_date',
    ];

    protected $hidden = ['id','created_at','updated_at'];

	protected $table = 'emails';
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    protected $fillable = ['reported_by','reported_msg','reported_topic'];
    protected $hidden = ['id','created_at','updated_at'];
    protected $table = 'reports';
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class timeline extends Model
{
    protected $fillable = ['userid','title','msg','status'];
    protected $hidden = ['id'];
    protected $table = 'timeline';
}

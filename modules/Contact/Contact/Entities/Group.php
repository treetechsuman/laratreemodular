<?php

namespace Modules\Contact\Entities;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name','status','user_id'];
    protected $hidden = [
        'remember_token',
    ];
}

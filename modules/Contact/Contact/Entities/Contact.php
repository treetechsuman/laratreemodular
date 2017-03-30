<?php

namespace Modules\Contact\Entities;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['first_name','middle_name','last_name','nick_name','dob','phone','email','user_id','group_id'];
}

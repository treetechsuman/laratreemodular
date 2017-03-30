<?php

namespace Modules\Sms\Entities;

use Illuminate\Database\Eloquent\Model;

class SMS extends Model
{
    protected $fillable = ['message','number','user_id'];
}

<?php

namespace Modules\App\Entities;

use Illuminate\Database\Eloquent\Model;

class AppPermission extends Model
{
    protected $fillable = ['app_id','permission_id'];
}

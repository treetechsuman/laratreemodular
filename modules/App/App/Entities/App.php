<?php

namespace Modules\App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class App extends Model implements AuthenticatableContract
{
    use Authenticatable;
    protected $fillable = ['name','app_key','app_secret',];
}

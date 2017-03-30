<?php

namespace Modules\Client\Entities;

use Illuminate\Database\Eloquent\Model;

class ClientPermission extends Model
{
    protected $fillable = ['client_id','permission_id'];
}

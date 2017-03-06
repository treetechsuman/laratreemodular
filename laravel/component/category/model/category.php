<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table='categories';
    protected $fillable=[
    'name',
    'organization_id',
    'created_by',
    'updated_by',
    'status',
    'parent_id'
    ];
     protected $hidden =[
        'updated_by',
        'created_by',
    ];
}

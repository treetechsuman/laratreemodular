<?php

namespace Modules\Form\Entities;

use Illuminate\Database\Eloquent\Model;

class option extends Model
{
    protected $fillable = [
    	'id',
    	'field_id',
    	'name',
    	'value',
    	'order'
    ];
}

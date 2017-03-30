<?php

namespace Modules\Form\Entities;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $fillable = [
    	'form_id',
    	'name',
    	'name_key',
    	'type',
    	'element_type',
    	'validation',
    	'regex'
    ];
}

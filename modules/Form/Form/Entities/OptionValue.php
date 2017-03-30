<?php

namespace Modules\Form\Entities;

use Illuminate\Database\Eloquent\Model;

class OptionValue extends Model
{
    protected $fillable = [
    	'value_id',
    	'option_id',
    ];
}

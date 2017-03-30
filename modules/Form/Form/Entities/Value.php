<?php

namespace Modules\Form\Entities;

use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    protected $fillable = [
    	'form_submission_id',
    	'field_id',
    	'value',
    ];
}

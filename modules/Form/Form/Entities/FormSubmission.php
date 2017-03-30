<?php

namespace Modules\Form\Entities;

use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    protected $fillable = [
    	'form_id',
    	'submission_date',
    	'version',
    ];
}

<?php

namespace Modules\Form\Entities;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [
    	'title',
    	'slag',
    	'submit_url',
        'version',
    	'query_params',
    	'email',
    	'email_template_name',
    	'auto_responder',
    	'notification',
    ];
}

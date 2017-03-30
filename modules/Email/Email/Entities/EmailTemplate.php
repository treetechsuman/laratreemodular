<?php

namespace Modules\Email\Entities;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $fillable = ['template_id','subject','message'];
}

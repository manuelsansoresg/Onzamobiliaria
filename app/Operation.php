<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    
    protected $fillable = [
        'description', 'status'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Realstate extends Model
{
    protected $table = 'realstates';
    protected $fillable = [
        'description', 'status'
    ];
}

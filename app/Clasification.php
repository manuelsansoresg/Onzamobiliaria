<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clasification extends Model
{
    protected $fillable = [
        'description', 'status'
    ];
}

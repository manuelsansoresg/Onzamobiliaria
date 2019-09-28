<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusFollow extends Model
{
    protected $fillable = [
        'description', 'status'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormPayment extends Model
{
    protected $fillable = [
        'description', 'status'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormPayment extends Model
{
    protected $fillable = [
        'description', 'status'
    ];


    static function myPayments($property_id)
    {
        $property = Property::find($property_id);
        $payments = explode(',' , $property->form_pays );
        return $payments;

    }

}

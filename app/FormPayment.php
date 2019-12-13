<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormPayment extends Model
{
    protected $fillable = [
        'description', 'status'
    ];

    static function getAll()
    {
        $payment = FormPayment::where('status', 1)->get();
        return $payment;
    }

    static function myPayments($property_id)
    {
        $property = Property::find($property_id);
        $payments = explode(',' , $property->form_pays );
        return $payments;

    }

    static function myPaymentsHistoric($historic_id){
        
        $historic = HistoricAssigment::find($historic_id);
        $payments = explode(',', $historic->forma_pago);
        return $payments;
    }

}

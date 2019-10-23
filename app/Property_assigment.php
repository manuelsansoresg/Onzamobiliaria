<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property_assigment extends Model
{
    protected $table='property_assignment';

    static function getAll()
    {
        $property = Property_assigment::select('realstates.description as realstate_description',
                                    'properties.id',
                                    'operations.description as operations_description',
                                    'form_payments.description as form_payment_description',
                                    'Avaluo',
                                    'assessment',
                                    'habitar',
                                    'is_property'
                                    )
                        ->join('realstates', 'realstates.id', '=', 'properties.realstate_id')
                        ->join('operations', 'operations.id', '=', 'properties.operation_id')
                        ->join('form_payments', 'form_payments.id', '=', 'properties.form_pay_id')
                        ->get();
        return $property;
    }
}

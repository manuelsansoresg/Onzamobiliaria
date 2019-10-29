<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property_assigment extends Model
{
    protected $table='property_assignment';

    static function getAll()
    {
        $property = Property_assigment::select('*'
                                    )
                       
                        ->get();
        return $property;
    }
}

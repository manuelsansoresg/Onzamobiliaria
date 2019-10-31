<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Property_assigment extends Model
{
    protected $table    = 'property_assignment';
    protected $fillable = ['property_id', 'name', 'date', 'status_follow_id', 'observation1', 'observation2', 'observation3', 'status_break', 'status'];
    

    static function getAll()
    {
        $user      = User::find(Auth::id());
        $user_role = $user->getRoleNames()->first();

        $property  = Property::select('properties.id', 'street', 'noInt', 'noExt', 'postal.codigo as codigo', 'colonia', 'pass_easy_broker')
                       //->join('property_assignment', 'property_assignment.property_id', '=', 'properties.id' )
                        ->join('postal', 'postal.id', '=', 'properties.postal_id')
                        ->where('properties.status', 1);
        
        if ($user_role != 'admin') {
            $property = $property->where('properties.user_id_capture', $user->id);
        }

        $property = $property->get();                
        return $property;
    }

    static function getById($property_id)
    {
        $property = Property_assigment::select('name', 'date', 'description', 'property_assignment.id', 'property_assignment.status')
                    ->where('property_id', $property_id)
                    ->join('status_follows', 'status_follows.id', '=', 'property_assignment.status_follow_id')
                    ->get();
        return $property;
    }
}

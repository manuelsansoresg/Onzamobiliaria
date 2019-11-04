<?php

namespace App;

use DateTime;
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

    static function countCalls($property_id)
    {
        $property = Property_assigment::select('property_id')->where('property_id', $property_id)->count();
        return $property;
    }

    static function getAlert($property_id)
    {
        #saber si se puso en contacto
        $property     = Property::select('date_assignment')->find($property_id);
        
        $date1        = new DateTime(date('Y-m-d H:i:s', strtotime($property->date_assignment)));
        $date2        = new DateTime("now");
        $diff         = $date1->diff($date2);
        $dias         = $diff->format('%d');
        $class_danger = '';

        if($dias > 0){
            $property = Property_assigment::select('property_id')->where('property_id', $property_id)->count();
            $class_danger = 'danger';
        }
        
        return $class_danger;
    }

}

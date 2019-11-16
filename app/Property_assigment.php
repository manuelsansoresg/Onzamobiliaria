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

        $property  = Property::select('properties.id', 'users.name', 'street', 'noInt', 'noExt', 'postal.codigo as codigo', 'colonia', 'pass_easy_broker', 'date_assignment')
                       //->join('property_assignment', 'property_assignment.property_id', '=', 'properties.id' )
                        ->join('postal', 'postal.id', '=', 'properties.postal_id')
                        ->join('users', 'properties.user_id_capture', '=' , 'users.id')
                        ->where('properties.status', 1);
        
        if ($user_role != 'admin') {
            $property = $property->where('properties.user_id_capture', $user->id);
        }

        $property = $property->get();                
        return $property;
    }

    static function getAllTable()
    {
        $properties = self::getAll();
        $table      = array();
        $user       = User::find(Auth::id());
        $user_role  = $user->getRoleNames()->first();

        if ($properties) {
            foreach ($properties as $property) {
                
                $llamadas = Property_assigment::where('property_id', $property->id)->count();
                $date1    = new DateTime(date('Y-m-d H:i:s', strtotime($property->date_assignment)));
                $date2    = new DateTime("now");
                $diff     = $date1->diff($date2);
                $dias     = $diff->format('%d');


                if ($user_role == 'admin') {
                    
                    $alert = '';

                    if ($dias > 0) {
                        $alert = '<i class="fas fa-exclamation-circle text-danger"></i>';
                    }
                    
                    $table[] = array(
                        $alert.' Calle:'. $property->street.' Número int:'.$property->noInt . ' Número ext:' . $property->noExt,
                                $property->pass_easy_broker,
                                $dias,
                                $property->name,
                                ' <a href="/admin/seguimiento-asesores/lista/'.$property->id.'" class="btn btn-primary">
                                    <i class="fas fa-phone-volume"></i>
                                </a>'
                                );
                }else{
                    
                    if ($dias < 1) {
                        
                        $table[] = array(
                                        'Calle:'.$property->street.' Número int:'.$property->noInt . ' Número ext:' . $property->noExt,
                                        $property->pass_easy_broker,
                                        $llamadas,
                                        
                                        ' <a href="/admin/seguimiento-asesores/lista/' . $property->id . '" class="btn btn-primary">
                                                <i class="fas fa-phone-volume"></i>
                                            </a>'
                                    );
                    }
                }
            }
        }


        //$table_head->{$title} = 'Dirección';

        /* 
         */
        if ($user_role == 'admin') {
            $table_head[] = array('title' => 'DIRECCIÓN');
            $table_head[] = array('title' => 'EASYBROKER');
            $table_head[] = array('title' => 'NÚMERO DE LLAMADAS');
            $table_head[] = array('title' => 'ASIGNADO');
            $table_head[] = array('title' => '');
        }else{
            $table_head[] = array('title' => 'DIRECCIÓN');
            $table_head[] = array('title' => 'EASYBROKER');
            $table_head[] = array('title' => 'NÚMERO DE LLAMADAS');
            $table_head[] = array('title' => '');
        }
        //$table_head = array('Dirección', 'Easybroker');
       
        
        return array('table' => $table, 'table_head' => $table_head );
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

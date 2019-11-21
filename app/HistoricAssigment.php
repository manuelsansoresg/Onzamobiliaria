<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class HistoricAssigment extends Model
{
    protected $fillable = ['property_assignment_id', 'observacion1', 'observacion2', 'observacion3', 'status_follow_id'];

    static function getById($id_assigment)
    {
        $user       = User::find(Auth::id());
        $user_role  = $user->getRoleNames()->first();

        $assigment = HistoricAssigment::select('historic_assigments.id', 'status_follows.description as status', 'historic_assigments.observacion1')
                                    ->join('property_assignment', 'property_assignment.id', '=', 'historic_assigments.property_assignment_id')
                                    ->join('status_follows', 'status_follows.id', '=', 'historic_assigments.status_follow_id')
                                    ->where('property_assignment_id', $id_assigment);
        if ($user_role != 'admin') {
            $assigment = $assigment->where('asesor_id', Auth::id());
        }

         $assigment =  $assigment ->get();

         return $assigment;
    }
}

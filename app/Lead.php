<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Lead extends Model
{
    protected $fillable = ['nombre', 'phone', 'ubicacion', 'share', 'operation_id', 'observation', 'status', 'fotos'];

    static function getById($id)
    {
        $user      = User::find(Auth::id());
        $user_role = $user->getRoleNames()->first();

        $lead = Lead::select('leads.id as id', 'street', 'n_in', 'n_out', 'phone', 'leads.date',  'leads.status',
                        'postal.codigo as codigo',
                        'leads.status',
                        'colonia',
            'postal_id',
            'realstate_id',
            'operation_id',
            'clasification_id' ,
            'share' ,
            'mobile' ,
            'observation1',
            'observation2',
            'observation3'
                            )
            ->join('realstates', 'realstates.id', '=', 'leads.realstate_id')
            ->join('operations', 'operations.id', '=', 'leads.operation_id')
            ->join('clasifications', 'clasifications.id', '=', 'leads.clasification_id')
            ->join('postal', 'postal.id', '=', 'leads.postal_id')
            ->where('leads.id', $id)
            ->first();

        
        return $lead;
       
    }

    static function getAll()
    {
        $user      = User::find(Auth::id());
        $user_role = $user->getRoleNames()->first();

        $lead = Lead::select('leads.id', 'street', 'n_in', 'n_out', 'phone', 'leads.date',  'leads.status')
            ->join('realstates', 'realstates.id', '=', 'leads.realstate_id')
            ->join('operations', 'operations.id', '=', 'leads.operation_id')
            ->join('clasifications', 'clasifications.id', '=', 'leads.clasification_id');

        if ($user_role != 'admin') {
            $lead = $lead->where('leads.user_id', $user->id);
        }

        $lead = $lead->get();
        return $lead;
    }

    static function createUpdate ($request, $path = false, $lead_id = null)
    {
        $share = isset($request->share) ? $request->share : 0; 
        
        if ($lead_id == null) {
            $lead = new Lead($request->except('_token', 'image'));
        }else{
            $lead = Lead::find($lead_id);
        }

       
        $lead->user_id = Auth::id();
        $lead->share   = $share;


        if ($lead_id == null) {
            $lead->save();
        } else {
            $lead->update();
        }

        if ($request->hasFile('image') != false) {
            $files = array();
           
            foreach ($_FILES['image'] as $k => $l) {
                foreach ($l as $i => $v) {
                    if (!array_key_exists($i, $files))
                        $files[$i] = array();
                    $files[$i][$k] = $v;
                }
            }


            $cont = -1;

            foreach ($files as $file) {
                $image_lead = new Images_lead();

                $cont               = $cont + 1;
                $image_cover        = $request->file('image')[$cont];
                $pre = 'lead' . $cont . '_';
                $image              = uploadImage($file, $image_cover, $path, true, $pre );

                $image_lead->lead_id = $lead->id;
                $image_lead->name =  $image;
                $image_lead->thumb = 'thumb_'.$image;
                $image_lead->save();

                
            }
        }

        return $lead;   

    }

    static function delete_images($path, $lead_id)
    {
        $lead_images = Images_lead::where('lead_id', $lead_id)->get();
        
        foreach ($lead_images as $lead) {
            @unlink($path . '/' . $lead->name);
            @unlink($path . '/' . $lead->thumb);
        }
        
        $lead = Lead::find($lead_id);
        $lead->delete();
       
    }

}

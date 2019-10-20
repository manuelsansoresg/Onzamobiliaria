<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{


    static function createProperty($request, $path)
    {
        
        $property = new Property();
        $property->realstate_id = $request->inmobiliaria;
        $property->realstate_id = $request->avaluo;

        
       
        
        if ($request->hasFile('documento') != false) {
            $documnet_file = $request->file('documento');
            $extension = $documnet_file->getClientOriginalExtension();
            $name_full = 'document_' . time() . '.' . $extension;
           
            $documnet_file->move('.'.$path, $name_full);
            
            
        }
    }

}

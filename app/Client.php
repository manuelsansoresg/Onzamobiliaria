<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['nombre', 'correo', 'telefono', 'medio_contacto', 'propiedad_interes', 'precio', 'titulo_propiedad', 'clave_interna', 'is_property', 'telefono2', 'telefono3'];

    static function create($request, $id = null)
    {
        if($id == null){
            $client = new Client($request->except('_token'));
            $client->save();
        }else{
            $client = Client::find($id);
            $client->fill($request->except('_token'));
            $client->update();
        }
       
    }


}

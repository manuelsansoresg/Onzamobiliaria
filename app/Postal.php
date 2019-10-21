<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postal extends Model
{
    protected $table = 'postal';

    static function getById($id)
    {
        $postals = null;
        $postal = Postal::find($id);
        
        if($postal){
            $postals = Postal::where('codigo', $postal->codigo )->get();
        }
        
        return array('postal' => $postal , 'postals' => $postals );
    }

}

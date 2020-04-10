<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vista extends Model
{
    protected $table = "vistas";
    public function pais(){
        $this->belongsTo("App\Country");
    }
}

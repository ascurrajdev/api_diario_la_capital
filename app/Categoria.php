<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = "categorias";
    public function color(){
        return $this->belongsTo('App\Color');
    }
    public function posts(){
        return $this->hasMany('App\Post');
    }
}

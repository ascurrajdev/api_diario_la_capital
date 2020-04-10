<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = "posts";
    public function categoria(){
        return $this->belongsTo('App\Categoria');
    }
    public function relevancia(){
        return $this->belongsTo('App\Relevancia','nivel_relevancia_id');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function vistas(){
        return $this->hasMany('App\Vista');
    }
    public function contenidoAdicional(){
        return $this->hasMany('App\ContenidoAdicional');
    }
}

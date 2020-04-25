<?php
namespace App\Http\Resources\Json;

use Illuminate\Http\Resources\Json\JsonResource;

class PostsJson extends JsonResource{
    public function toArray($request){
        return [
            'id'=>$this->id,
            'categoria'=>$this->categoria->nombre_categoria,
            'autor'=>$this->user->name,
            'introduccion'=>$this->introduccion_noticia,
            'contenido'=>$this->contenido_noticia,
            'titulo'=>$this->titulo_noticia,
            'creacion'=>date("Y-m-d H:i:s",strtotime($this->created_at)),
            'vistas'=>$this->vistas->count(),
            'recursos'=>ContenidoAdicionalJson::collection($this->contenidoAdicional),
        ];
    }
}
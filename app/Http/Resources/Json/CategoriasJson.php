<?php
namespace App\Http\Resources\Json;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PostsCategoriaCollection;
use App\Post;
class CategoriasJson extends JsonResource{
    public function toArray($request){
        return [
            'id'=>$this->id,
            'nombre' => $this->nombre_categoria,
            'noticias'=>PostsJson::collection($this->posts()->orderBy('id','desc')->get()),
        ];
    }
}
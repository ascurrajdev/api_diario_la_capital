<?php
namespace App\Http\Resources\Json;
use Illuminate\Http\Resources\Json\JsonResource;
class CategoriasJson extends JsonResource{
    public function toArray($request){
        return [
            'id'=>$this->id,
            'nombre' => $this->nombre_categoria,
            'noticias'=> PostsJson::collection($this->posts),
        ];
    }
}
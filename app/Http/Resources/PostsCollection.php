<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Json\PostsJson;
use App\Categoria;
use App\Http\Resources\Json\CategoriasJson;
class PostsCollection extends ResourceCollection{
    public function toArray($request){
        return [
            "noticiasRecientes" => ["noticias" => PostsJson::collection($this->collection)],
            "categorias" => CategoriasJson::collection(Categoria::all()),
            "cantidad" => $this->collection->count()
        ];
    }
}
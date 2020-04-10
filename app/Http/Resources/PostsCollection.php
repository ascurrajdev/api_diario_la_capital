<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Json\PostsJson;

class PostsCollection extends ResourceCollection{
    public function toArray($request){
        return [
            "noticias" => PostsJson::collection($this->collection),
            "cantidad" => $this->collection->count()
        ];
    }
}
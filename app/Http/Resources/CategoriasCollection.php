<?php

namespace App\Http\Resources;
use App\Http\Resources\Json\CategoriasSimpleJson;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoriasCollection extends ResourceCollection{
    public function toArray($request){
        return [
            'categorias' => CategoriasSimpleJson::collection($this->collection),
        ]; 
    }
}
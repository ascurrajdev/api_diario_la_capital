<?php
namespace App\Http\Resources;
use App\Http\Resources\Json\EncuestaJson;
use Illuminate\Http\Resources\Json\ResourceCollection;
class EncuestaCollection extends ResourceCollection{
    public function toArray($request){
        return [
            'encuestas'=> EncuestaJson::collection($this->collection),
        ];
    }
}
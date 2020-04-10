<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Json\VistaJson;
class VistasCollection extends ResourceCollection{
    public function toArray($request){
        return [
            'vistas'=>VistaJson::collection($this->collection),
        ];
    }
}
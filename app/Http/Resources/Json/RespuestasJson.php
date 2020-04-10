<?php
namespace App\Http\Resources\Json;

use Illuminate\Http\Resources\Json\JsonResource;
class RespuestasJson extends JsonResource{
    public function toArray($request){
        return [
            'opcion'=>$this->opcion_id,
            'comentario'=>$this->comentario,
        ];
    }
}
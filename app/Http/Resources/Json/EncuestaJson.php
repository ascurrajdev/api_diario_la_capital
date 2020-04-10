<?php
namespace App\Http\Resources\Json;

use Illuminate\Http\Resources\Json\JsonResource;

class EncuestaJson extends JsonResource{
    public function toArray($request){
        return [
            'id'=>$this->id,
            'contenido'=>$this->contenido,
            'opciones'=>$this->opciones,
            'respuestas'=>RespuestasJson::collection($this->respuestas),
            'vistas'=>$this->respuestas->count(),
        ];
    }
}
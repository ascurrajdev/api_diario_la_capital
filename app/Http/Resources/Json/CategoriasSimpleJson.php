<?php
namespace App\Http\Resources\Json;
use Illuminate\Http\Resources\Json\JsonResource;
class CategoriasSimpleJson extends JsonResource{
    public function toArray($request){
        return [
            'id'=>$this->id,
            'nombre' => $this->nombre_categoria,
        ];
    }
}
<?php
namespace App\Http\Resources\Json;

use Illuminate\Http\Resources\Json\JsonResource;

class VistaJson extends JsonResource{
    public function toArray($request){
        return [
            'id'=>$this->id,
        ];
    }
}
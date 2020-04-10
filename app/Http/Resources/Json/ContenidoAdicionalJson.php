<?php
namespace App\Http\Resources\Json;
use Illuminate\Http\Resources\Json\JsonResource;
class ContenidoAdicionalJson extends JsonResource{
    public function toArray($request){
        return [
            'url'=>$this->asset_url,
        ];
    }
}
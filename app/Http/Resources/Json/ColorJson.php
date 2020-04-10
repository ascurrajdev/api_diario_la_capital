<?php
namespace App\Http\Resources\Json;
use Illuminate\Http\Resources\Json\JsonResource;
class ColorJson extends JsonResource
{
    public function toArray($request){
        return [
            'style_color' => $this->style_color,
        ];
    }
}
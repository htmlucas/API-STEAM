<?php
namespace App\Http\Resources\Steam;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlayerResource extends JsonResource {

    public function toArray($request): array 
    {
        return [
            'id'     => $this->id,
            'name'   => $this->name,
            'avatar' => $this->avatar,
        ];
    }
}
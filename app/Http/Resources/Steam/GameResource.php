<?php
namespace App\Http\Resources\Steam;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource {

    public function toArray($request): array 
    {
        return [
            'app_id'   => $this->appId,
            'name'     => $this->name,
            'playtime' => [
                'minutes' => $this->playtimeMinutes,
                'hours'   => round($this->playtimeMinutes / 60, 1),
            ],
        ];
    }
}
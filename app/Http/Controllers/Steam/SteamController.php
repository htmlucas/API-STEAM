<?php

namespace App\Http\Controllers\Steam;

use App\Domain\Steam\Services\SteamService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Steam\SteamIdRequest;
use App\Http\Resources\Steam\GameResource;
use App\Http\Resources\Steam\PlayerResource;
use Illuminate\Http\Request;

class SteamController extends Controller
{
    public function __construct(private SteamService $service) {}

    public function get_profile(SteamIdRequest $req)
    {
        
        $player = $this->service->getPlayer($req->steamId);
        return new PlayerResource($player);
    }

    public function games(SteamIdRequest $req)
    {
        $games = $this->service->getOwnedGames($req->steamId);
        return GameResource::collection(collect($games));
    }
}


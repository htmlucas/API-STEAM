<?php
namespace App\Domain\Steam\Services;

use Illuminate\Support\Facades\Cache;
use App\Domain\Steam\DTOs\{PlayerDTO, GameDTO};

class SteamService
{
    public function __construct(private SteamClient $client) {}

    public function getPlayer(string $steamId): PlayerDTO
    {
        $data = Cache::remember("steam:player:$steamId", now()->addMinutes(10), function () use ($steamId) {
            return $this->client->getPlayerSummaries($steamId);
        });

        $player = $data['response']['players'][0] ?? null;

        return new PlayerDTO(
            id: (string)($player['steamid'] ?? $steamId),
            name: $player['personaname'] ?? 'Unknown',
            avatar: $player['avatarfull'] ?? null,
        );
    }

    public function getOwnedGames(string $steamId): array
    {
        $data = Cache::remember("steam:owned-games:$steamId", now()->addMinutes(15), function () use ($steamId) {
            return $this->client->getOwnedGames($steamId, true);
        });

        $games = $data['response']['games'] ?? [];
        return array_map(fn($g) => new GameDTO(
            appId: (int)$g['appid'],
            name: $g['name'] ?? 'Unknown',
            playtimeMinutes: (int)($g['playtime_forever'] ?? 0)
        ), $games);
    }
}

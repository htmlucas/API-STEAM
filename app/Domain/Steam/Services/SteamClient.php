<?php
namespace App\Domain\Steam\Services;

use Illuminate\Support\Facades\Http;
use App\Domain\Steam\Exceptions\SteamApiException;

class SteamClient
{
    public function __construct(
        private string $baseUrl = '',
        private string $key = '',
    ) {
        $this->baseUrl = $this->baseUrl ?: config('services.steam.base_url');
        $this->key     = $this->key     ?: config('services.steam.key');
    }

    private function http()
    {
        return Http::baseUrl($this->baseUrl)
            ->timeout(config('services.steam.timeout', 8))
            ->retry(3, 200)                 // retry com backoff
            ->withQueryParameters(['key' => $this->key]);
    }

    public function getPlayerSummaries(string $steamId): array
    {
        $res = $this->http()->get('ISteamUser/GetPlayerSummaries/v2/', [
            'steamids' => $steamId,
        ]);

        if ($res->failed()) {
            throw new SteamApiException('GetPlayerSummaries failed', $res->status(), $res->json());
        }

        return $res->json();
    }

    public function getOwnedGames(string $steamId, bool $withInfo = true): array
    {
        $res = $this->http()->get('IPlayerService/GetOwnedGames/v1/', [
            'steamid' => $steamId,
            'include_appinfo' => $withInfo,
            'include_played_free_games' => true,
        ]);

        if ($res->failed()) {
            throw new SteamApiException('GetOwnedGames failed', $res->status(), $res->json());
        }

        return $res->json();
    }
}

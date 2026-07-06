<?php

namespace App\Support;

use App\Models\Client;
use Illuminate\Support\Collection;

class SiteContent
{
    /**
     * @return Collection<int, Client>
     */
    public static function publishedClients(): Collection
    {
        $clients = Client::published()->get();

        if ($clients->isNotEmpty()) {
            return $clients;
        }

        return collect(config('frames.brands', []))->values()->map(function (string $name, int $index) {
            return new Client([
                'name' => $name,
                'sort_order' => $index,
                'is_published' => true,
            ]);
        });
    }
}

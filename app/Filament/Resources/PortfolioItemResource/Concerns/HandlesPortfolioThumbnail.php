<?php

namespace App\Filament\Resources\PortfolioItemResource\Concerns;

use App\Models\PortfolioItem;

trait HandlesPortfolioThumbnail
{
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $path = PortfolioItem::normalizeMediaPath($data['thumbnail_url'] ?? null);

        if (filled($path) && PortfolioItem::isStoredUpload($path)) {
            $data['thumbnail_upload'] = [$path];
        }

        return $data;
    }

    protected function normalizePortfolioData(array $data): array
    {
        if (filled($data['youtube_url'] ?? null)) {
            $data['youtube_url'] = PortfolioItem::normalizeYoutubeUrl($data['youtube_url']);
        }

        if (filled($data['thumbnail_url'] ?? null)) {
            $data['thumbnail_url'] = PortfolioItem::normalizeMediaPath($data['thumbnail_url']);
        }

        return $data;
    }
}

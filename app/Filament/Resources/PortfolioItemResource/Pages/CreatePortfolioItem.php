<?php

namespace App\Filament\Resources\PortfolioItemResource\Pages;

use App\Filament\Resources\PortfolioItemResource;
use App\Filament\Resources\PortfolioItemResource\Concerns\HandlesPortfolioThumbnail;
use Filament\Resources\Pages\CreateRecord;

class CreatePortfolioItem extends CreateRecord
{
    use HandlesPortfolioThumbnail;

    protected static string $resource = PortfolioItemResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return $this->normalizePortfolioData($data);
    }
}

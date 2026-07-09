<?php

namespace App\Filament\Resources\PortfolioItemResource\Pages;

use App\Filament\Resources\PortfolioItemResource;
use App\Filament\Resources\PortfolioItemResource\Concerns\HandlesPortfolioThumbnail;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPortfolioItem extends EditRecord
{
    use HandlesPortfolioThumbnail;

    protected static string $resource = PortfolioItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        return $this->normalizePortfolioData($data);
    }
}

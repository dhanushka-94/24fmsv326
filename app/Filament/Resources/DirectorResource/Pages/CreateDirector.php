<?php

namespace App\Filament\Resources\DirectorResource\Pages;

use App\Filament\Resources\DirectorResource;
use App\Filament\Resources\DirectorResource\Concerns\HandlesDirectorPhoto;
use Filament\Resources\Pages\CreateRecord;

class CreateDirector extends CreateRecord
{
    use HandlesDirectorPhoto;

    protected static string $resource = DirectorResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return $this->normalizeDirectorData($data);
    }
}

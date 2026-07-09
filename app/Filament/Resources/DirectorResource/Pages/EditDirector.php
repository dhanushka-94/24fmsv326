<?php

namespace App\Filament\Resources\DirectorResource\Pages;

use App\Filament\Resources\DirectorResource;
use App\Filament\Resources\DirectorResource\Concerns\HandlesDirectorPhoto;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDirector extends EditRecord
{
    use HandlesDirectorPhoto;

    protected static string $resource = DirectorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

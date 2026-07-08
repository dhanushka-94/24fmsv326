<?php

namespace App\Filament\Resources\TeamMemberResource\Pages;

use App\Filament\Resources\TeamMemberResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTeamMember extends EditRecord
{
    protected static string $resource = TeamMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (
            blank($data['photo'] ?? null)
            && filled($this->record->photo)
            && ! TeamMember::isStoredUpload($this->record->photo)
        ) {
            $data['photo'] = $this->record->photo;
        }

        return $data;
    }
}

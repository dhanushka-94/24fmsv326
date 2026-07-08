<?php

namespace App\Filament\Resources\TeamMemberResource\Pages;

use App\Filament\Resources\TeamMemberResource;
use App\Filament\Resources\TeamMemberResource\Concerns\HandlesTeamMemberPhoto;
use App\Models\TeamMember;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTeamMember extends EditRecord
{
    use HandlesTeamMemberPhoto;

    protected static string $resource = TeamMemberResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data = $this->normalizeTeamMemberPhoto($data);

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

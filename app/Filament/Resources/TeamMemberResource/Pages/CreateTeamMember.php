<?php

namespace App\Filament\Resources\TeamMemberResource\Pages;

use App\Filament\Resources\TeamMemberResource;
use App\Filament\Resources\TeamMemberResource\Concerns\HandlesTeamMemberPhoto;
use Filament\Resources\Pages\CreateRecord;

class CreateTeamMember extends CreateRecord
{
    use HandlesTeamMemberPhoto;

    protected static string $resource = TeamMemberResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return $this->normalizeTeamMemberPhoto($data);
    }
}

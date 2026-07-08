<?php

namespace App\Filament\Resources\TeamMemberResource\Concerns;

use App\Models\TeamMember;

trait HandlesTeamMemberPhoto
{
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $path = TeamMember::normalizePhotoPath($data['photo'] ?? null);

        if (filled($path) && TeamMember::isStoredUpload($path)) {
            $data['photo_upload'] = [$path];
        }

        return $data;
    }

    protected function normalizeTeamMemberPhoto(array $data): array
    {
        if (filled($data['photo'] ?? null)) {
            $data['photo'] = TeamMember::normalizePhotoPath($data['photo']);
        }

        return $data;
    }
}

<?php

namespace App\Filament\Resources\DirectorResource\Concerns;

use App\Models\Director;

trait HandlesDirectorPhoto
{
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $path = Director::normalizePhotoPath($data['photo'] ?? null);

        if (filled($path) && Director::isStoredUpload($path)) {
            $data['photo_upload'] = [$path];
        }

        return $data;
    }

    protected function normalizeDirectorData(array $data): array
    {
        if (filled($data['photo'] ?? null)) {
            $data['photo'] = Director::normalizePhotoPath($data['photo']);
        }

        return $data;
    }
}

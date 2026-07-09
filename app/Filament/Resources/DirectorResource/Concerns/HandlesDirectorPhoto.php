<?php

namespace App\Filament\Resources\DirectorResource\Concerns;

use App\Models\Director;

trait HandlesDirectorPhoto
{
    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (filled($data['photo'] ?? null)) {
            $data['photo'] = Director::normalizePhotoPath($data['photo']);
        } elseif (
            filled($this->record->photo)
            && ! Director::isStoredUpload($this->record->photo)
        ) {
            $data['photo'] = $this->record->photo;
        }

        return $data;
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (filled($data['photo'] ?? null)) {
            $data['photo'] = Director::normalizePhotoPath($data['photo']);
        }

        return $data;
    }
}

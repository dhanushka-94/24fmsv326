<?php

namespace App\Models;

use App\Support\Frames;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'role',
        'department',
        'name',
        'bio',
        'photo',
        'imdb',
        'instagram',
        'linkedin',
        'sort_order',
        'is_published',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true)->orderBy('sort_order');
    }

    public function photoUrl(): ?string
    {
        if (blank($this->photo)) {
            return null;
        }

        $path = static::normalizePhotoPath($this->photo);

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return Frames::mediaUrl($path);
    }

    public function storedPhotoPath(): ?string
    {
        if (! static::isStoredUpload($this->photo)) {
            return null;
        }

        return static::normalizePhotoPath($this->photo);
    }

    public static function normalizePhotoPath(?string $path): ?string
    {
        if ($path === null || $path === '') {
            return null;
        }

        $path = trim($path);

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (str_starts_with($path, '/storage/')) {
            return ltrim(substr($path, strlen('/storage/')), '/');
        }

        if (str_starts_with($path, 'storage/')) {
            return ltrim(substr($path, strlen('storage/')), '/');
        }

        return $path;
    }

    public static function isStoredUpload(?string $path): bool
    {
        $normalized = static::normalizePhotoPath($path);

        if ($normalized === null || $normalized === '') {
            return false;
        }

        return ! str_starts_with($normalized, 'http://')
            && ! str_starts_with($normalized, 'https://')
            && ! str_starts_with($normalized, '/');
    }
}

<?php

namespace App\Models;

use App\Support\Frames;
use Illuminate\Database\Eloquent\Model;

class PortfolioItem extends Model
{
    protected $fillable = [
        'title',
        'category',
        'description',
        'thumbnail_url',
        'youtube_url',
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

    public function thumbnailSrc(): ?string
    {
        return Frames::mediaUrl(static::normalizeMediaPath($this->thumbnail_url));
    }

    public static function normalizeYoutubeUrl(?string $url): ?string
    {
        if ($url === null || trim($url) === '') {
            return null;
        }

        $url = trim($url);

        if (! str_starts_with($url, 'http://') && ! str_starts_with($url, 'https://')) {
            $url = 'https://'.$url;
        }

        return $url;
    }

    public static function normalizeMediaPath(?string $path): ?string
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
        $normalized = static::normalizeMediaPath($path);

        if ($normalized === null || $normalized === '') {
            return false;
        }

        return ! str_starts_with($normalized, 'http://')
            && ! str_starts_with($normalized, 'https://')
            && ! str_starts_with($normalized, '/');
    }

    public function youtubeId(): ?string
    {
        $raw = trim((string) $this->youtube_url);

        if ($raw === '') {
            return null;
        }

        if (preg_match('/^[A-Za-z0-9_-]{11}$/', $raw)) {
            return $raw;
        }

        $url = static::normalizeYoutubeUrl($raw);

        if (! $url) {
            return null;
        }

        if (preg_match('~(?:youtu\.be/|youtube\.com/(?:embed/|v/|shorts/|live/))([A-Za-z0-9_-]{11})~i', $url, $matches)) {
            return $matches[1];
        }

        if (preg_match('/[?&]v=([A-Za-z0-9_-]{11})/', $url, $matches)) {
            return $matches[1];
        }

        return null;
    }

    public function embedUrl(bool $autoplay = true): ?string
    {
        $id = $this->youtubeId();

        if (! $id) {
            return null;
        }

        $query = $autoplay ? '?autoplay=1&rel=0' : '?rel=0';

        return "https://www.youtube.com/embed/{$id}{$query}";
    }

    public function heroThumbnailSrc(): ?string
    {
        if ($this->thumbnail_url) {
            if ($thumbnail = $this->thumbnailSrc()) {
                return $thumbnail;
            }
        }

        if ($id = $this->youtubeId()) {
            return "https://img.youtube.com/vi/{$id}/maxresdefault.jpg";
        }

        return null;
    }
}

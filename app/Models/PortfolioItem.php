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
        return Frames::mediaUrl($this->thumbnail_url);
    }

    public function youtubeId(): ?string
    {
        if (! $this->youtube_url) {
            return null;
        }

        if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|shorts\/|live\/|watch\?v=))([A-Za-z0-9_-]{11})/', $this->youtube_url, $matches)) {
            return $matches[1];
        }

        if (preg_match('/^[A-Za-z0-9_-]{11}$/', trim($this->youtube_url))) {
            return trim($this->youtube_url);
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
        if ($thumbnail = $this->thumbnailSrc()) {
            return $thumbnail;
        }

        if ($id = $this->youtubeId()) {
            return "https://img.youtube.com/vi/{$id}/maxresdefault.jpg";
        }

        return null;
    }
}

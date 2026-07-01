<?php

namespace App\Models;

use App\Support\Frames;
use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    protected $fillable = [
        'name',
        'photo',
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

    public function getPhotoUrlAttribute(): ?string
    {
        return Frames::mediaUrl($this->photo);
    }

    /**
     * @return array{name: string, photo: string|null}
     */
    public function toDisplayArray(): array
    {
        return [
            'name' => $this->name,
            'photo' => $this->photo_url,
        ];
    }
}

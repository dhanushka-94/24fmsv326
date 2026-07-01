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
        return Frames::mediaUrl($this->photo);
    }
}

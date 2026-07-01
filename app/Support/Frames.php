<?php

namespace App\Support;

class Frames
{
    public static function brandingUrl(string $key, ?string $default = null): string
    {
        $default ??= config("frames.{$key}");
        $stored = \App\Models\SiteSetting::get($key, $default);

        return static::mediaUrl($stored) ?? static::mediaUrl($default) ?? '';
    }

    public static function mediaUrl(?string $path): ?string
    {
        if ($path === null || $path === '') {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (str_starts_with($path, '/')) {
            return asset($path);
        }

        return asset('storage/'.$path);
    }
}

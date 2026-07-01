<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    public static function get(string $key, ?string $default = null): ?string
    {
        if (! static::tableExists()) {
            return $default;
        }

        return Cache::rememberForever(static::cacheKey($key), function () use ($key, $default) {
            return static::query()->where('key', $key)->value('value') ?? $default;
        });
    }

    public static function set(string $key, ?string $value): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => static::normalizeStoredPath($value)],
        );

        Cache::forget(static::cacheKey($key));
        Cache::forget(static::cacheKey('*'));
    }

    public static function normalizeStoredPath(?string $value): ?string
    {
        if ($value === null || $value === '') {
            return null;
        }

        $value = trim($value);

        if (str_starts_with($value, 'http://') || str_starts_with($value, 'https://')) {
            $path = parse_url($value, PHP_URL_PATH);

            return is_string($path) && $path !== '' ? $path : $value;
        }

        return $value;
    }

    public static function ensureBrandingDefaults(): void
    {
        if (! static::tableExists()) {
            return;
        }

        $defaults = [
            'logo_white' => '/images/24frames-logo-white.png',
            'logo_red' => '/images/24frames-logo-red.png',
            'favicon' => '/images/24frames-logo-red.png',
        ];

        foreach ($defaults as $key => $path) {
            $current = static::query()->where('key', $key)->value('value');

            if (! $current) {
                static::set($key, $path);

                continue;
            }

            $normalized = static::normalizeStoredPath($current);

            if ($normalized !== $current) {
                static::set($key, $normalized);
            }
        }
    }

    /**
     * @return array<string, string|null>
     */
    public static function allCached(): array
    {
        if (! static::tableExists()) {
            return [];
        }

        return Cache::rememberForever(static::cacheKey('*'), function () {
            return static::query()->pluck('value', 'key')->all();
        });
    }

    public static function flushCache(): void
    {
        if (! static::tableExists()) {
            return;
        }

        foreach (static::query()->pluck('key') as $key) {
            Cache::forget(static::cacheKey($key));
        }

        Cache::forget(static::cacheKey('*'));
    }

    protected static function cacheKey(string $key): string
    {
        return 'site_setting.'.$key;
    }

    protected static function tableExists(): bool
    {
        try {
            return \Illuminate\Support\Facades\Schema::hasTable('site_settings');
        } catch (\Throwable) {
            return false;
        }
    }
}

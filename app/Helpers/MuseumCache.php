<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cache;

class MuseumCache
{
    /**
     * Flexible remember wrapper around Laravel Cache.
     *
     * Supported signatures:
     *  - remember($key, $callback, $ttl = null)
     *  - remember($key, $ttl, $callback)                 // Laravel style
     *  - remember($group, $key, $callback, $ttl = null)   // grouped cache
     */
    public static function remember(...$args)
    {
        [$group, $key, $callback, $ttl] = self::parseRememberArgs($args);

        $cacheKey = $group !== null
            ? 'museum:' . $group . ':' . $key
            : 'museum:' . $key;

        $registryGroup = $group ?? $key;

        // Ensure the key is registered for later group flushes even on cache hit.
        self::registerKey($registryGroup, $cacheKey);

        if ($ttl === null) {
            return Cache::rememberForever($cacheKey, function () use ($callback) {
                return $callback();
            });
        }

        return Cache::remember($cacheKey, $ttl, function () use ($callback) {
            return $callback();
        });
    }

    /**
     * Flush all cached entries registered under the given group/key.
     */
    public static function flush($group): void
    {
        $registryKey = 'museum:group:' . $group . ':keys';

        $keys = Cache::get($registryKey, []);
        if (is_array($keys)) {
            foreach ($keys as $cacheKey) {
                Cache::forget($cacheKey);
            }
        }

        Cache::forget($registryKey);
        // Also forget a directly stored entry that uses the group name as key.
        Cache::forget('museum:' . $group);
    }

    /**
     * Forget a single cache key (best effort).
     */
    public static function forget($key): void
    {
        Cache::forget('museum:' . $key);
    }

    protected static function parseRememberArgs(array $args): array
    {
        $group = null;
        $key = null;
        $callback = null;
        $ttl = null;

        $count = count($args);

        if ($count === 2) {
            $key = $args[0];
            $callback = $args[1];
        } elseif ($count === 3) {
            if (is_callable($args[1])) {
                // remember($key, $callback, $ttlOrGroup)
                $key = $args[0];
                $callback = $args[1];
                if (is_int($args[2]) || $args[2] instanceof \DateInterval || $args[2] instanceof \DateTimeInterface) {
                    $ttl = $args[2];
                } else {
                    $group = $args[2];
                }
            } elseif (is_callable($args[2])) {
                if (is_int($args[1]) || $args[1] instanceof \DateInterval || $args[1] instanceof \DateTimeInterface) {
                    // remember($key, $ttl, $callback)
                    $key = $args[0];
                    $ttl = $args[1];
                    $callback = $args[2];
                } else {
                    // remember($group, $key, $callback)
                    $group = $args[0];
                    $key = $args[1];
                    $callback = $args[2];
                }
            }
        } elseif ($count === 4) {
            // remember($group, $key, $callback, $ttl)
            $group = $args[0];
            $key = $args[1];
            $callback = $args[2];
            $ttl = $args[3];
        }

        if ($key === null) {
            $key = $args[0] ?? null;
        }

        return [$group, $key, $callback, $ttl];
    }

    protected static function registerKey(string $group, string $cacheKey): void
    {
        $registryKey = 'museum:group:' . $group . ':keys';
        $keys = Cache::get($registryKey, []);
        if (!is_array($keys)) {
            $keys = [];
        }
        if (!in_array($cacheKey, $keys, true)) {
            $keys[] = $cacheKey;
            Cache::forever($registryKey, $keys);
        }
    }
}


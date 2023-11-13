<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class CacheManager
{
    protected $cache;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    public function get($key)
    {
        return Cache::get($key);
    }

    public function put($key, $val, $duration)
    {
        return Cache::put($key, $val, $duration);
    }

    public function delete($key)
    {
        return Cache::delete($key);
    }

    public function has($key)
    {
        return Cache::has($key);
    }
}

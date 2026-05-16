<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

trait InteractsWithRedisCache
{
    public function getLatestCacheByPrefix(string $prefix, int $limit = 5)
    {
        
        $keys = array_slice(Cache::get($prefix, []), -$limit);

        $result = [];
 
        foreach ($keys as $key) {
            $result[$key] = Cache::get($key);
        }
        return $result;

    }
}
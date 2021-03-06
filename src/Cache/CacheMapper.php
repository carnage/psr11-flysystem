<?php
declare(strict_types=1);

namespace WShafer\PSR11FlySystem\Cache;

use WShafer\PSR11FlySystem\MapperAbstract;

class CacheMapper extends MapperAbstract
{
    public function getFactoryClassName(string $type)
    {
        if (class_exists($type) && $type != 'memcached') {
            return $type;
        }

        switch ($type) {
            case 'adaptor':
            case 'adapter':
                return AdaptorCacheFactory::class;
            case 'psr6':
                return Psr6CacheFactory::class;
            case 'memory':
                return MemoryCacheFactory::class;
            case 'predis':
                return PredisCacheFactory::class;
            case 'memcached':
                return MemcachedCacheFactory::class;
        }

        return null;
    }
}

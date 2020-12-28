<?php

namespace Helldar\Support\Facades\Helpers;

use Helldar\Support\Facades\BaseFacade;
use Helldar\Support\Helpers\Arr as Helper;

/**
 * @method static array addUnique(array $array, $values)
 * @method static array except(array $array, array|string $keys)
 * @method static array map(array $array, callable $callback)
 * @method static array merge(...$arrays)
 * @method static array only(array $array, array|string $keys)
 * @method static array renameKeys(array $array, callable $callback)
 * @method static array renameKeysMap(array $array, array $map)
 * @method static array sortByKeys(array $array, array $sorter)
 * @method static array toArray($value = null)
 * @method static array wrap($value = null)
 * @method static bool exists(array $array, $key)
 * @method static bool isArrayable($value = null)
 * @method static int longestStringLength(array $array)
 * @method static mixed get(array $array, $key, $default = null)
 * @method static mixed getKeyIfExist(array $array, $key, $default = null)
 * @method static void store(array $array, string $path, bool $is_json = false, bool $sort_keys = false)
 * @method static void storeAsArray(array $array, string $path, bool $sort_keys = false)
 * @method static void storeAsJson(array $array, string $path, bool $sort_keys = false)
 */
final class Arr extends BaseFacade
{
    protected static function getFacadeAccessor()
    {
        return Helper::class;
    }
}
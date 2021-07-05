<?php

namespace Helldar\Support\Facades\Helpers;

use Helldar\Support\Concerns\Deprecation;
use Helldar\Support\Facades\Facade;
use Helldar\Support\Facades\Helpers\Http\Uri;
use Helldar\Support\Helpers\Http as Helper;

/**
 * @method static bool exists(?string $url)
 * @method static bool isUrl(?string $url)
 * @method static string domain(?string $url)
 * @method static string host(?string $url)
 * @method static string scheme(?string $url)
 * @method static string validatedUrl(?string $url)
 * @method static string|null image(string $url, string $default = null)
 * @method static string|null subdomain(?string $url)
 * @method static void validateUrl(?string $url)
 *
 * @deprecated since 4.0: Use `Helldar\Support\Facades\Helpers\Http\Uri` instead.
 */
final class Http extends Facade
{
    use Deprecation;

    public static function __callStatic($method, $args)
    {
        self::deprecatedClass(Uri::class);

        return parent::__callStatic($method, $args);
    }

    protected static function getFacadeAccessor()
    {
        return Helper::class;
    }
}

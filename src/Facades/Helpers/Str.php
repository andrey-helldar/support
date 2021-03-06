<?php
/******************************************************************************
 * This file is part of the "andrey-helldar/support" project.                 *
 *                                                                            *
 * @author Andrey Helldar <helldar@ai-rus.com>                                *
 *                                                                            *
 * @copyright 2021 Andrey Helldar                                             *
 *                                                                            *
 * @license MIT                                                               *
 *                                                                            *
 * @see https://github.com/andrey-helldar/support                             *
 *                                                                            *
 * For the full copyright and license information, please view the LICENSE    *
 * file that was distributed with this source code.                           *
 ******************************************************************************/

namespace Helldar\Support\Facades\Helpers;

use Helldar\Support\Facades\Facade;
use Helldar\Support\Helpers\Str as Helper;

/**
 * @method static \Helldar\Support\Facades\Helpers\Ables\Stringable of(?string $value)
 * @method static bool contains(string $haystack, $needles)
 * @method static bool doesntEmpty($value)
 * @method static bool endsWith(string $haystack, string|string[] $needles)
 * @method static bool isEmpty($value)
 * @method static bool startsWith(string $haystack, string|string[] $needles)
 * @method static int length(?string $value, string $encoding = null)
 * @method static string ascii(?string $value, string $language = 'en')
 * @method static string convertToString(?string $value)
 * @method static string random(int $length = 16)
 * @method static string replace(string $template, array $values, string $key_format = null)
 * @method static string slug(string $title, string $separator = '-', ?string $language = 'en')
 * @method static string|null after(string $subject, string $search)
 * @method static string|null before(string $subject, string $search)
 * @method static string|null camel(?string $value)
 * @method static string|null choice(float $number, array $choice = [], string $extra = null)
 * @method static string|null de(?string $value)
 * @method static string|null e(?string $value, bool $double = true)
 * @method static string|null end(?string $value, string $suffix)
 * @method static string|null finish(string $value, string $cap = '/')
 * @method static string|null lower(?string $value)
 * @method static string|null match(string $value, string $pattern)
 * @method static string|null pregReplace(?string $value, string $pattern, string $replacement)
 * @method static string|null removeSpaces(?string $value)
 * @method static string|null snake(?string $value, string $delimiter = '_')
 * @method static string|null start(?string $value, string $prefix)
 * @method static string|null studly(?string $value)
 * @method static string|null substr(string $string, int $start, int $length = null)
 * @method static string|null title(?string $value)
 * @method static string|null upper(?string $value)
 */
class Str extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Helper::class;
    }
}

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

namespace Helldar\Support\Concerns;

use Helldar\Support\Exceptions\ForbiddenVariableTypeException;
use Helldar\Support\Facades\Helpers\Ables\Arrayable;
use Helldar\Support\Facades\Helpers\Str;

trait Validation
{
    /**
     * @param  mixed  $haystack
     * @param  array|string  $needles
     */
    protected function validateType($haystack, $needles): void
    {
        $type    = $this->validateGetType($haystack);
        $needles = $this->validateNeedles($needles);

        if (! Str::contains($type, $needles)) {
            throw new ForbiddenVariableTypeException($type, $needles);
        }
    }

    protected function validateNeedles($values): array
    {
        return Arrayable::of($values)
            ->map(static function ($value) {
                return Str::lower($value);
            })->get();
    }

    protected function validateGetType($haystack): string
    {
        return Str::lower(gettype($haystack));
    }
}

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

namespace Helldar\Support\Tools;

use Helldar\Support\Concerns\Makeable;
use Helldar\Support\Facades\Helpers\Str;
use Stringable;

class HttpBuilderPrepare implements Stringable
{
    use Makeable;

    protected $of;

    protected $prefix = '';

    protected $suffix = '';

    protected $default = '';

    public function __toString(): string
    {
        if (! empty($this->of)) {
            return $this->prefixed();
        }

        return $this->default;
    }

    public function of(?string $value): self
    {
        $this->of = $value;

        return $this;
    }

    public function prefix(string $value): self
    {
        $this->prefix = $value;

        return $this;
    }

    public function suffix(string $value): self
    {
        $this->suffix = $value;

        return $this;
    }

    protected function prefixed(): ?string
    {
        return (string) Str::of($this->of)
            ->start($this->prefix)
            ->finish($this->suffix)
            ->trim();
    }
}

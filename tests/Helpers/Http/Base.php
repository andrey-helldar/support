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

namespace Tests\Helpers\Http;

use Helldar\Support\Helpers\Http\Builder;
use Tests\Fixtures\Instances\Psr;
use Tests\TestCase;

abstract class Base extends TestCase
{
    protected $test_url = 'https://en.example.com/';

    protected $psr_url = 'https://foo:bar@en.example.com:8901/foo/bar?id=123&name=hey#qwerty';

    protected $psr_scheme = 'https';

    protected $psr_user = 'foo';

    protected $psr_pass = 'bar';

    protected $psr_host = 'en.example.com';

    protected $psr_port = 8901;

    protected $psr_path = '/foo/bar';

    protected $psr_query = 'id=123&name=hey';

    protected $psr_fragment = 'qwerty';

    protected function builder(): Builder
    {
        return new Builder();
    }

    protected function psr(bool $empty = false): Psr
    {
        if ($empty) {
            return Psr::make();
        }

        return Psr::make()
            ->withScheme($this->psr_scheme)
            ->withUserInfo($this->psr_user, $this->psr_pass)
            ->withHost($this->psr_host)
            ->withPort($this->psr_port)
            ->withPath($this->psr_path)
            ->withQuery($this->psr_query)
            ->withFragment($this->psr_fragment);
    }
}

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

namespace Tests\Facades\Helpers\Http\Builder;

use Helldar\Support\Facades\Http\Builder as BuilderFacade;
use Tests\Facades\Helpers\Http\Base;

class PutQueryMethodTest extends Base
{
    public function testWith()
    {
        $builder = BuilderFacade::parse($this->psr_url);

        $this->assertIsString($builder->getQuery());
        $this->assertSame($this->psr_query, $builder->getQuery());

        $builder->putQuery('foo', 'Foo');
        $builder->putQuery('bar', 'Bar');
        $builder->putQuery('baz', ['First', 'Second']);

        $this->assertIsString($builder->getQuery());
        $this->assertSame('id=123&name=hey&foo=Foo&bar=Bar&baz%5B0%5D=First&baz%5B1%5D=Second', $builder->getQuery());
    }

    public function testWithout()
    {
        $builder = BuilderFacade::parse($this->test_url);

        $this->assertIsString($builder->getQuery());
        $this->assertEmpty($builder->getQuery());

        $builder->putQuery('foo', 'Foo');
        $builder->putQuery('bar', 'Bar');
        $builder->putQuery('baz', ['First', 'Second']);

        $this->assertIsString($builder->getQuery());
        $this->assertSame('foo=Foo&bar=Bar&baz%5B0%5D=First&baz%5B1%5D=Second', $builder->getQuery());
    }

    public function testEmpty()
    {
        $builder = BuilderFacade::parse($this->test_url);

        $this->assertIsString($builder->getQuery());
        $this->assertEmpty($builder->getQuery());

        $builder->putQuery('foo', '');

        $this->assertIsString($builder->getQuery());
        $this->assertSame('', $builder->getQuery());
    }

    public function testNull()
    {
        $builder = BuilderFacade::parse($this->test_url);

        $this->assertIsString($builder->getQuery());
        $this->assertEmpty($builder->getQuery());

        $builder->putQuery('foo', null);

        $this->assertIsString($builder->getQuery());
        $this->assertSame('', $builder->getQuery());
    }
}

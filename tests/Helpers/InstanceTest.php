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

namespace Tests\Helpers;

use Helldar\Support\Helpers\Instance;
use Tests\Fixtures\Contracts\Contract;
use Tests\Fixtures\Instances\Bar;
use Tests\Fixtures\Instances\Baz;
use Tests\Fixtures\Instances\Foo;
use Tests\TestCase;

class InstanceTest extends TestCase
{
    public function testOf()
    {
        // Foo
        $this->assertTrue($this->instance()->of(Foo::class, Foo::class));
        $this->assertFalse($this->instance()->of(Foo::class, Bar::class));
        $this->assertTrue($this->instance()->of(Foo::class, Contract::class));

        $this->assertTrue($this->instance()->of(new Foo(), Foo::class));
        $this->assertFalse($this->instance()->of(new Foo(), Bar::class));
        $this->assertTrue($this->instance()->of(new Foo(), Contract::class));

        // Bar
        $this->assertTrue($this->instance()->of(Bar::class, Bar::class));
        $this->assertFalse($this->instance()->of(Bar::class, Foo::class));
        $this->assertFalse($this->instance()->of(Bar::class, Contract::class));

        $this->assertTrue($this->instance()->of(new Bar(), Bar::class));
        $this->assertFalse($this->instance()->of(new Bar(), Foo::class));
        $this->assertFalse($this->instance()->of(new Bar(), Contract::class));
    }

    public function testClassname()
    {
        $this->assertSame('Tests\Fixtures\Instances\Foo', $this->instance()->classname(Foo::class));
        $this->assertSame('Tests\Fixtures\Instances\Bar', $this->instance()->classname(Bar::class));
        $this->assertSame('Tests\Fixtures\Instances\Baz', $this->instance()->classname(Baz::class));

        $this->assertSame('Tests\Fixtures\Instances\Foo', $this->instance()->classname(new Foo()));
        $this->assertSame('Tests\Fixtures\Instances\Bar', $this->instance()->classname(new Bar()));
        $this->assertSame('Tests\Fixtures\Instances\Baz', $this->instance()->classname(new Baz()));

        $this->assertSame('Tests\Fixtures\Contracts\Contract', $this->instance()->classname(Contract::class));

        $this->assertNull($this->instance()->classname('foo'));
    }

    public function testBasename()
    {
        $this->assertSame('Foo', $this->instance()->basename(Foo::class));
        $this->assertSame('Bar', $this->instance()->basename(Bar::class));
        $this->assertSame('Baz', $this->instance()->basename(Baz::class));

        $this->assertSame('Foo', $this->instance()->basename(new Foo()));
        $this->assertSame('Bar', $this->instance()->basename(new Bar()));
        $this->assertSame('Baz', $this->instance()->basename(new Baz()));

        $this->assertNull($this->instance()->basename('foo'));
    }

    public function testExists()
    {
        $this->assertTrue($this->instance()->exists(new Foo()));
        $this->assertTrue($this->instance()->exists(new Bar()));
        $this->assertTrue($this->instance()->exists(new Baz()));

        $this->assertTrue($this->instance()->exists(Foo::class));
        $this->assertTrue($this->instance()->exists(Bar::class));
        $this->assertTrue($this->instance()->exists(Baz::class));

        $this->assertTrue($this->instance()->exists(Contract::class));

        $this->assertFalse($this->instance()->exists('foo'));
    }

    protected function instance(): Instance
    {
        return new Instance();
    }
}

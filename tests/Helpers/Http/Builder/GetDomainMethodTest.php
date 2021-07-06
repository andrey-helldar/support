<?php

namespace Tests\Helpers\Http\Builder;

use Tests\Helpers\Http\Base;

class GetDomainMethodTest extends Base
{
    public function testShort()
    {
        $builder = $this->builder()->parse($this->test_url);

        $this->assertIsString($builder->getDomain());
        $this->assertSame('en.example.com', $builder->getDomain());
    }

    public function testFull()
    {
        $builder = $this->builder()->parse($this->psr_url);

        $this->assertIsString($builder->getDomain());
        $this->assertSame('en.example.com', $builder->getDomain());
    }

    public function testEmpty()
    {
        $builder = $this->builder();

        $this->assertIsString($builder->getDomain());
        $this->assertEmpty($builder->getDomain());
    }
}

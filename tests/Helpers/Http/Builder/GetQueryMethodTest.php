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

namespace Tests\Helpers\Http\Builder;

use Tests\Helpers\Http\Base;

class GetQueryMethodTest extends Base
{
    public function testWith()
    {
        $builder = $this->builder()->parse($this->psr_url);

        $this->assertIsString($builder->getQuery());
        $this->assertSame($this->psr_query, $builder->getQuery());
    }

    public function testWithout()
    {
        $builder = $this->builder()->parse($this->test_url);

        $this->assertIsString($builder->getQuery());
        $this->assertEmpty($builder->getQuery());
    }
}

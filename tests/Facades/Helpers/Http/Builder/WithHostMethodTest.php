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

class WithHostMethodTest extends Base
{
    public function testEmpty()
    {
        $this->assertIsString(BuilderFacade::withHost('')->getHost());
        $this->assertEmpty(BuilderFacade::withHost('')->getHost());
    }

    public function testNull()
    {
        $this->assertIsString(BuilderFacade::withHost(null)->getHost());
        $this->assertEmpty(BuilderFacade::withHost(null)->getHost());
    }
}

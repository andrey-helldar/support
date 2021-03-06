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

namespace Tests\Exceptions;

use ArgumentCountError;
use Helldar\Support\Exceptions\FileNotFoundException;
use Tests\TestCase;

class FileNotFoundExceptionTest extends TestCase
{
    public function testPath()
    {
        $this->expectException(FileNotFoundException::class);
        $this->expectExceptionMessage('File "foo/bar" does not exist.');

        throw new FileNotFoundException('foo/bar');
    }

    public function testEmptyPath()
    {
        $this->expectException(FileNotFoundException::class);
        $this->expectExceptionMessage('File "" does not exist.');

        throw new FileNotFoundException(null);
    }

    public function testWithoutParameter()
    {
        $this->expectException(ArgumentCountError::class);

        throw new FileNotFoundException();
    }
}

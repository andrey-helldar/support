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

namespace Tests\Facades\Helpers;

use Helldar\Support\Facades\Helpers\Str;
use Helldar\Support\Helpers\Ables\Stringable;
use Tests\Fixtures\Instances\Arrayable;
use Tests\Fixtures\Instances\Baq;
use Tests\Fixtures\Instances\Bar;
use Tests\Fixtures\Instances\Baz;
use Tests\Fixtures\Instances\Foo;
use Tests\TestCase;

class StrTest extends TestCase
{
    public function testOf()
    {
        $this->assertSame('', (string) Str::of(''));
        $this->assertInstanceOf(Stringable::class, Str::of(''));

        $this->assertSame('', (string) Str::of(null));
        $this->assertInstanceOf(Stringable::class, Str::of(null));

        $this->assertSame('foo', (string) Str::of('foo'));
        $this->assertInstanceOf(Stringable::class, Str::of('foo'));
    }

    public function testAfter()
    {
        $this->assertSame('Bar', Str::after('Foo Bar', ' '));
        $this->assertSame('BaR', Str::after('FoO BaR', ' '));
        $this->assertSame('bar', Str::after('foo bar', ' '));
        $this->assertSame('FoO-BaR', Str::after('FoO-BaR', ' '));
        $this->assertSame('   BaR', Str::after('FoO   -   BaR', '-'));
        $this->assertSame('  BaR', Str::after('FoO   -   BaR', ' - '));
    }

    public function testBefore()
    {
        $this->assertSame('Foo', Str::before('Foo Bar', ' '));
        $this->assertSame('FoO', Str::before('FoO BaR', ' '));
        $this->assertSame('foo', Str::before('foo bar', ' '));
        $this->assertSame('FoO-BaR', Str::before('FoO-BaR', ' '));
        $this->assertSame('FoO   ', Str::before('FoO   -   BaR', '-'));
        $this->assertSame('FoO  ', Str::before('FoO   -   BaR', ' - '));
    }

    public function testCamel()
    {
        $this->assertSame('fooBar', Str::camel('Foo Bar'));
        $this->assertSame('foOBaR', Str::camel('FoO BaR'));
        $this->assertSame('fooBar', Str::camel('foo bar'));
        $this->assertSame('foOBaR', Str::camel('FoO-BaR'));
        $this->assertSame('foOBaR', Str::camel('FoO   -   BaR'));
    }

    public function testSnake()
    {
        $this->assertSame('foo_bar', Str::snake('Foo Bar'));
        $this->assertSame('fo_o_ba_r', Str::snake('FoO BaR'));
        $this->assertSame('foo_bar', Str::snake('foo bar'));
        $this->assertSame('fo_o-_ba_r', Str::snake('FoO-BaR'));
        $this->assertSame('fo_o-_ba_r', Str::snake('FoO   -   BaR'));
    }

    public function testSlug()
    {
        $this->assertSame('hello-world', Str::slug('hello world'));
        $this->assertSame('hello-world', Str::slug('hello-world'));
        $this->assertSame('hello-world', Str::slug('hello_world'));
        $this->assertSame('hello_world', Str::slug('hello_world', '_'));
        $this->assertSame('user-at-host', Str::slug('user@host'));
        $this->assertSame('سلام-دنیا', Str::slug('سلام دنیا', '-', null));
        $this->assertSame('sometext', Str::slug('some text', ''));
        $this->assertSame('privetmir', Str::slug('Привет, мир!', ''));
        $this->assertSame('', Str::slug('', ''));
        $this->assertSame('', Str::slug(''));
    }

    public function testTitle()
    {
        $this->assertSame('Foo Bar', Str::title('Foo Bar'));
        $this->assertSame('Foo Bar', Str::title('FoO BaR'));
        $this->assertSame('Foo Bar', Str::title('foo bar'));
        $this->assertSame('Foo-Bar', Str::title('FoO-BaR'));
        $this->assertSame('Foo   -   Bar', Str::title('FoO   -   BaR'));

        $this->assertSame('123', Str::title('123'));
        $this->assertSame('123', Str::title(123));

        $this->assertSame('0', Str::title('0'));
        $this->assertSame('0', Str::title(0));

        $this->assertNull(Str::title(''));
        $this->assertNull(Str::title(null));
        $this->assertNull(Str::title(false));
    }

    public function testStart()
    {
        $this->assertSame('/test/string', Str::start('test/string', '/'));
        $this->assertSame('/test/string', Str::start('/test/string', '/'));
        $this->assertSame('/test/string', Str::start('//test/string', '/'));
    }

    public function testStartsWith()
    {
        $this->assertTrue(Str::startsWith('jason', 'jas'));
        $this->assertTrue(Str::startsWith('jason', 'jason'));
        $this->assertTrue(Str::startsWith('jason', ['jas']));
        $this->assertTrue(Str::startsWith('jason', ['day', 'jas']));
        $this->assertFalse(Str::startsWith('jason', 'day'));
        $this->assertFalse(Str::startsWith('jason', ['day']));
        $this->assertFalse(Str::startsWith('jason', null));
        $this->assertFalse(Str::startsWith('jason', [null]));
        $this->assertFalse(Str::startsWith('0123', [null]));
        $this->assertTrue(Str::startsWith('0123', 0));
        $this->assertFalse(Str::startsWith('jason', 'J'));
        $this->assertFalse(Str::startsWith('jason', ''));
        $this->assertFalse(Str::startsWith('', ''));
        $this->assertFalse(Str::startsWith('7', ' 7'));
        $this->assertTrue(Str::startsWith('7a', '7'));
        $this->assertTrue(Str::startsWith('7a', 7));
        $this->assertTrue(Str::startsWith('7.12a', 7.12));
        $this->assertFalse(Str::startsWith('7.12a', 7.13));
        $this->assertTrue(Str::startsWith(7.123, '7'));
        $this->assertTrue(Str::startsWith(7.123, '7.12'));
        $this->assertFalse(Str::startsWith(7.123, '7.13'));

        // Test for multibyte string support
        $this->assertTrue(Str::startsWith('Jönköping', 'Jö'));
        $this->assertTrue(Str::startsWith('Malmö', 'Malmö'));
        $this->assertFalse(Str::startsWith('Jönköping', 'Jonko'));
        $this->assertFalse(Str::startsWith('Malmö', 'Malmo'));
        $this->assertTrue(Str::startsWith('你好', '你'));
        $this->assertFalse(Str::startsWith('你好', '好'));
        $this->assertFalse(Str::startsWith('你好', 'a'));
    }

    public function testEnd()
    {
        $this->assertSame('test/string/', Str::end('test/string', '/'));
        $this->assertSame('test/string/', Str::end('/test/string', '/'));
        $this->assertSame('test/string/', Str::end('//test/string', '/'));
    }

    public function testEndsWith()
    {
        $this->assertTrue(Str::endsWith('jason', 'on'));
        $this->assertTrue(Str::endsWith('jason', 'jason'));
        $this->assertTrue(Str::endsWith('jason', ['on']));
        $this->assertTrue(Str::endsWith('jason', ['no', 'on']));
        $this->assertFalse(Str::endsWith('jason', 'no'));
        $this->assertFalse(Str::endsWith('jason', ['no']));
        $this->assertFalse(Str::endsWith('jason', ''));
        $this->assertFalse(Str::endsWith('', ''));
        $this->assertFalse(Str::endsWith('jason', [null]));
        $this->assertFalse(Str::endsWith('jason', null));
        $this->assertFalse(Str::endsWith('jason', 'N'));
        $this->assertFalse(Str::endsWith('7', ' 7'));
        $this->assertTrue(Str::endsWith('a7', '7'));
        $this->assertTrue(Str::endsWith('a7', 7));
        $this->assertTrue(Str::endsWith('a7.12', 7.12));
        $this->assertFalse(Str::endsWith('a7.12', 7.13));
        $this->assertTrue(Str::endsWith(0.27, '7'));
        $this->assertTrue(Str::endsWith(0.27, '0.27'));
        $this->assertFalse(Str::endsWith(0.27, '8'));

        // Test for multibyte string support
        $this->assertTrue(Str::endsWith('Jönköping', 'öping'));
        $this->assertTrue(Str::endsWith('Malmö', 'mö'));
        $this->assertFalse(Str::endsWith('Jönköping', 'oping'));
        $this->assertFalse(Str::endsWith('Malmö', 'mo'));
        $this->assertTrue(Str::endsWith('你好', '好'));
        $this->assertFalse(Str::endsWith('你好', '你'));
        $this->assertFalse(Str::endsWith('你好', 'a'));
    }

    public function testLength()
    {
        $this->assertSame(11, Str::length('foo bar baz'));
        $this->assertSame(11, Str::length('foo bar baz', 'UTF-8'));
    }

    public function testRemoveSpaces()
    {
        $this->assertEquals('foo bar', Str::removeSpaces('foo bar'));
        $this->assertEquals('foo bar', Str::removeSpaces('foo  bar'));
        $this->assertEquals('foo bar', Str::removeSpaces('foo    bar'));

        $this->assertEquals('foo bar baz', Str::removeSpaces('foo bar  baz'));
        $this->assertEquals('foo bar baz', Str::removeSpaces('foo  bar     baz'));
        $this->assertEquals('foo bar baz', Str::removeSpaces('foo    bar baz'));
    }

    public function testLower()
    {
        $this->assertSame('foo bar baz', Str::lower('FOO BAR BAZ'));
        $this->assertSame('foo bar baz', Str::lower('fOo Bar bAz'));
    }

    public function testUpper()
    {
        $this->assertSame('FOO BAR BAZ', Str::upper('FOO BAR BAZ'));
        $this->assertSame('FOO BAR BAZ', Str::upper('fOo Bar bAz'));
    }

    public function testFinish()
    {
        $this->assertSame('ab/', Str::finish('ab'));
        $this->assertSame('abbc', Str::finish('ab', 'bc'));
        $this->assertSame('abbc', Str::finish('abbcbc', 'bc'));
        $this->assertSame('abcbbc', Str::finish('abcbbcbc', 'bc'));
    }

    public function testStudly()
    {
        $this->assertSame('FooBar', Str::studly('Foo Bar'));
        $this->assertSame('FoOBaR', Str::studly('FoO BaR'));
        $this->assertSame('FooBar', Str::studly('foo bar'));
        $this->assertSame('FoOBaR', Str::studly('FoO-BaR'));
        $this->assertSame('FoOBaR', Str::studly('FoO   -   BaR'));
    }

    public function testDe()
    {
        $this->assertEquals('foo"bar', Str::de('foo&quot;bar'));
        $this->assertEquals('foo&bar', Str::de('foo&amp;bar'));
        $this->assertEquals("foo'bar", Str::de('foo&#039;bar'));
        $this->assertEquals("foo'bar", Str::de('foo&#039;bar'));
        $this->assertEquals('foo\\\'bar', Str::de('foo\&#039;bar'));

        $this->assertEquals('Foo->bar with space', Str::de('Foo-&gt;bar with space'));
        $this->assertEquals('A#symbol^and%a$few@special!chars~`', Str::de('A#symbol^and%a$few@special!chars~`'));
    }

    public function testE()
    {
        $this->assertSame('foo&quot;bar', Str::e('foo"bar'));
        $this->assertSame('foo&amp;bar', Str::e('foo&bar'));
        $this->assertSame('foo&#039;bar', Str::e('foo\'bar'));
        $this->assertSame('foo&#039;bar', Str::e("foo'bar"));
        $this->assertSame('foo\&#039;bar', Str::e('foo\\\'bar'));

        $this->assertSame('Foo-&gt;bar with space', Str::e('Foo->bar with space'));
        $this->assertSame('A#symbol^and%a$few@special!chars~`', Str::e('A#symbol^and%a$few@special!chars~`'));
    }

    public function testChoice()
    {
        $this->assertEquals('user', Str::choice(1, ['user', 'users', 'users']));
        $this->assertEquals('users', Str::choice(5, ['user', 'users', 'users']));
        $this->assertEquals('users', Str::choice(20, ['user', 'users', 'users']));

        $this->assertEquals('user of this', Str::choice(1, ['user', 'users', 'users'], 'of this'));
        $this->assertEquals('users of this', Str::choice(5, ['user', 'users', 'users'], 'of this'));
        $this->assertEquals('users of this', Str::choice(20, ['user', 'users', 'users'], 'of this'));
    }

    public function testSubstr()
    {
        $this->assertSame('Ё', Str::substr('БГДЖИЛЁ', -1));
        $this->assertSame('ЛЁ', Str::substr('БГДЖИЛЁ', -2));
        $this->assertSame('И', Str::substr('БГДЖИЛЁ', -3, 1));
        $this->assertSame('ДЖИЛ', Str::substr('БГДЖИЛЁ', 2, -1));
        $this->assertSame('ИЛ', Str::substr('БГДЖИЛЁ', -3, -1));
        $this->assertSame('ГДЖИЛЁ', Str::substr('БГДЖИЛЁ', 1));
        $this->assertSame('ГДЖ', Str::substr('БГДЖИЛЁ', 1, 3));
        $this->assertSame('БГДЖ', Str::substr('БГДЖИЛЁ', 0, 4));
        $this->assertSame('Ё', Str::substr('БГДЖИЛЁ', -1, 1));

        $this->assertEmpty(Str::substr('БГДЖИЛЁ', 4, -4));
        $this->assertEmpty(Str::substr('Б', 2));
    }

    public function testReplace()
    {
        $this->assertSame('foo', Str::replace('foo', ['a' => 'Z', 's' => 'X']));
        $this->assertSame('fQQ', Str::replace('foo', ['a' => 'Z', 's' => 'X', 'o' => 'Q']));
        $this->assertSame('Eoo', Str::replace('foo', ['a' => 'Z', 's' => 'X', 'f' => 'E']));
        $this->assertSame('EPP', Str::replace('foo', ['a' => 'Z', 's' => 'X', 'f' => 'E', 'o' => 'P']));

        $this->assertSame('bZr', Str::replace('bar', ['a' => 'Z', 's' => 'X']));
        $this->assertSame('bZr', Str::replace('bar', ['a' => 'Z', 's' => 'X', 'o' => 'Q']));
        $this->assertSame('bZr', Str::replace('bar', ['a' => 'Z', 's' => 'X', 'f' => 'E']));
        $this->assertSame('bZr', Str::replace('bar', ['a' => 'Z', 's' => 'X', 'f' => 'E', 'o' => 'P']));

        $this->assertSame('foo', Str::replace('foo', ['a' => 'Z', 's' => 'X'], '{%s}'));
        $this->assertSame('foo', Str::replace('foo', ['a' => 'Z', 's' => 'X', 'o' => 'Q'], '{%s}'));
        $this->assertSame('foo', Str::replace('foo', ['a' => 'Z', 's' => 'X', 'f' => 'E'], '{%s}'));
        $this->assertSame('foo', Str::replace('foo', ['a' => 'Z', 's' => 'X', 'f' => 'E', 'o' => 'P'], '{%s}'));

        $this->assertSame('bZr', Str::replace('b{a}r', ['a' => 'Z', 's' => 'X'], '{%s}'));
        $this->assertSame('bZr', Str::replace('b{a}r', ['a' => 'Z', 's' => 'X', 'o' => 'Q'], '{%s}'));
        $this->assertSame('bZr', Str::replace('b{a}r', ['a' => 'Z', 's' => 'X', 'f' => 'E'], '{%s}'));
        $this->assertSame('bZr', Str::replace('b{a}r', ['a' => 'Z', 's' => 'X', 'f' => 'E', 'o' => 'P'], '{%s}'));

        $this->assertSame('bZz', Str::replace('b_a_z', ['a' => 'Z', 's' => 'X'], '_%s_'));
        $this->assertSame('bZz', Str::replace('b_a_z', ['a' => 'Z', 's' => 'X', 'o' => 'Q'], '_%s_'));
        $this->assertSame('bZz', Str::replace('b_a_z', ['a' => 'Z', 's' => 'X', 'f' => 'E'], '_%s_'));
        $this->assertSame('bZz', Str::replace('b_a_z', ['a' => 'Z', 's' => 'X', 'f' => 'E', 'o' => 'P'], '_%s_'));
    }

    public function testStrContains()
    {
        $this->assertTrue(Str::contains('qwerty', 'ert'));
        $this->assertTrue(Str::contains('qwerty', 'qwerty'));
        $this->assertTrue(Str::contains('qwerty', ['ert']));
        $this->assertTrue(Str::contains('qwerty', ['xxx', 'ert']));

        $this->assertFalse(Str::contains('qwerty', 'xxx'));
        $this->assertFalse(Str::contains('qwerty', ['xxx']));
        $this->assertFalse(Str::contains('qwerty', ''));
        $this->assertFalse(Str::contains('qwerty', null));
        $this->assertFalse(Str::contains('qwerty', [null]));
        $this->assertFalse(Str::contains('qwerty', [0]));
        $this->assertFalse(Str::contains('qwerty', ['0']));
        $this->assertFalse(Str::contains('qwerty', 0));
        $this->assertFalse(Str::contains('qwerty', '0'));
        $this->assertFalse(Str::contains('', ''));
    }

    public function testRandom()
    {
        $this->assertEquals(16, strlen(Str::random()));

        $randomInteger = random_int(1, 100);

        $this->assertEquals($randomInteger, strlen(Str::random($randomInteger)));

        $this->assertIsString(Str::random());
    }

    public function testIsEmpty()
    {
        $this->assertTrue(Str::isEmpty(''));
        $this->assertTrue(Str::isEmpty(' '));
        $this->assertTrue(Str::isEmpty('      '));
        $this->assertTrue(Str::isEmpty(null));

        $this->assertFalse(Str::isEmpty(0));
        $this->assertFalse(Str::isEmpty('   0   '));
        $this->assertFalse(Str::isEmpty(false));
        $this->assertFalse(Str::isEmpty([]));

        $this->assertFalse(Str::isEmpty(new Foo()));
        $this->assertFalse(Str::isEmpty(new Bar()));
        $this->assertFalse(Str::isEmpty(new Baz()));
        $this->assertFalse(Str::isEmpty(new Baq()));
        $this->assertFalse(Str::isEmpty(new Arrayable()));
    }

    public function testDoesntEmpty()
    {
        $this->assertFalse(Str::doesntEmpty(''));
        $this->assertFalse(Str::doesntEmpty(' '));
        $this->assertFalse(Str::doesntEmpty('      '));
        $this->assertFalse(Str::doesntEmpty(null));

        $this->assertTrue(Str::doesntEmpty(0));
        $this->assertTrue(Str::doesntEmpty('   0   '));
        $this->assertTrue(Str::doesntEmpty(false));
        $this->assertTrue(Str::doesntEmpty([]));

        $this->assertTrue(Str::doesntEmpty(new Foo()));
        $this->assertTrue(Str::doesntEmpty(new Bar()));
        $this->assertTrue(Str::doesntEmpty(new Baz()));
        $this->assertTrue(Str::doesntEmpty(new Baq()));
        $this->assertTrue(Str::doesntEmpty(new Arrayable()));
    }

    public function testAscii()
    {
        $this->assertSame('', Str::ascii(null));

        $this->assertSame('@', Str::ascii('@'));
        $this->assertSame('u', Str::ascii('ü'));

        $this->assertSame('h H sht Sht a A ia yo', Str::ascii('х Х щ Щ ъ Ъ иа йо', 'bg'));
        $this->assertSame('ae oe ue Ae Oe Ue', Str::ascii('ä ö ü Ä Ö Ü', 'de'));
    }

    public function testConvertToString()
    {
        $this->assertSame('', Str::convertToString(''));
        $this->assertSame('null', Str::convertToString(null));
        $this->assertSame('foo', Str::convertToString('foo'));
        $this->assertSame('bar', Str::convertToString('bar'));
    }

    public function testMatch()
    {
        $this->assertSame('bar', Str::match('foo bar', '/bar/'));
        $this->assertSame('bar', Str::match('foo bar', '/foo (.*)/'));

        $this->assertNull(Str::match('foo bar', '/nothing/'));
    }

    public function testPregReplace()
    {
        $this->assertSame('', Str::pregReplace('', '!\s+!', ''));
        $this->assertSame('', Str::pregReplace(' ', '!\s+!', ''));
        $this->assertSame('', Str::pregReplace(null, '!\s+!', ''));

        $this->assertSame('foobar', Str::pregReplace('foo bar', '!\s+!', ''));
        $this->assertSame('foo-bar', Str::pregReplace('foo bar', '!\s+!', '-'));
        $this->assertSame('foo-bar', Str::pregReplace('foo     bar', '!\s+!', '-'));

        $this->assertSame('71234567890', Str::pregReplace('abc 7 (123)  456-78-90', '!(\W|\D)+!', ''));
    }
}

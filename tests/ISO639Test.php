<?php


namespace Wooppay\tests;


use OutOfBoundsException;
use PHPUnit\Framework\TestCase;
use Wooppay\iso639\controllers\Iso639;


class ISO639Test extends TestCase
{
	const ISO_639_1 = 'zh';
	const ISO_639_2t = 'zho';
	const ISO_639_2b = 'chi';
	const ISO_639_3 = 'zho';
	const NATIVE_NAME = '中文 (Zhōngwén), 汉语, 漢語';
	const ISO_NAME = 'Chinese';
	const FAKE_CODE = 'vv';

	public function testGet639_2tFrom639_1()
	{
		$converter = new ISO639();
		$result = $converter->convert(self::ISO_639_1, $converter::SUB_FORMAT_639_2t);
		$this->assertTrue($result == self::ISO_639_2t);
	}

	public function testGet639_2bFrom639_1()
	{
		$converter = new ISO639();
		$result = $converter->convert(self::ISO_639_1, $converter::SUB_FORMAT_639_2b);
		$this->assertTrue($result == self::ISO_639_2b);
	}

	public function testGet639_3From639_1()
	{
		$converter = new ISO639();
		$result = $converter->convert(self::ISO_639_1, $converter::SUB_FORMAT_639_3);
		$this->assertTrue($result == self::ISO_639_3);
	}

	public function testGetNativeNameFrom639_1()
	{
		$converter = new ISO639();
		$result = $converter->convert(self::ISO_639_1, $converter::NATIVE);
		$this->assertTrue($result == self::NATIVE_NAME);
	}

	public function testGetISONameFrom639_1()
	{
		$converter = new ISO639();
		$result = $converter->convert(self::ISO_639_1, $converter::ISO);
		$this->assertTrue($result == self::ISO_NAME);
	}


	public function testGet6392tFrom639_1()
	{
		$converter = new ISO639();
		$this->expectException(OutOfBoundsException::class);
		$converter->convert(self::ISO_639_1, $converter::SUB_FORMAT_639_2t);
	}
}
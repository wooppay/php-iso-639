<?php


namespace Wooppay\tests;


use PHPUnit\Framework\TestCase;
use Wooppay\ISO639\ISO639;
use \OutOfBoundsException;

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
		$result = $converter->convertCode($converter::NAME_OF_639_1, $converter::NAME_OF_639_2t, self::ISO_639_1);
		$this->assertTrue($result == self::ISO_639_2t);
	}

	public function testGet639_2bFrom639_1()
	{
		$converter = new ISO639();
		$result = $converter->convertCode($converter::NAME_OF_639_1, $converter::NAME_OF_639_2b, self::ISO_639_1);
		$this->assertTrue($result == self::ISO_639_2b);
	}

	public function testGet639_3From639_1()
	{
		$converter = new ISO639();
		$result = $converter->convertCode($converter::NAME_OF_639_1, $converter::NAME_OF_639_3, self::ISO_639_1);
		$this->assertTrue($result == self::ISO_639_3);
	}

	public function testGetNativeNameFrom639_1()
	{
		$converter = new ISO639();
		$result = $converter->convertCode($converter::NAME_OF_639_1, $converter::NATIVE_NAME, self::ISO_639_1);
		$this->assertTrue($result == self::NATIVE_NAME);
	}

	public function testGetISONameFrom639_1()
	{
		$converter = new ISO639();
		$result = $converter->convertCode($converter::NAME_OF_639_1, $converter::ISO_NAME, self::ISO_639_1);
		$this->assertTrue($result == self::ISO_NAME);
	}


	public function testGet6392tFrom639_1()
	{
		$converter = new ISO639();
		$this->expectException(OutOfBoundsException::class);
		$converter->convertCode($converter::NAME_OF_639_1, $converter::NAME_OF_639_2t, self::FAKE_CODE);
	}
}
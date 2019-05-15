<?php


namespace Wooppay\iso639\controllers;

use OutOfBoundsException;
use Yii;
use yii2lab\extension\store\Store;

class Iso639
{
	/**
	 * ISO standard names
	 */
	const NAME_OF_639_1 = '639-1';
	const NAME_OF_639_2t = '639-2/t';
	const NAME_OF_639_2b = '639-2/b';
	const NAME_OF_639_3 = '639-3';

	const NATIVE_NAME = 'Native';
	const ISO_NAME = 'ISO';

	private $format = 'php';
	private $languages;
	private $store;
	private $fileName;
	/**
	 * Array keys
	 */
	private const KEY_OF_639_1 = 0;
	private const KEY_OF_639_2t = 1;
	private const KEY_OF_639_2b = 2;
	private const KEY_OF_639_3 = 3;
	private const KEY_OF_ISO_NAME = 4;
	private const KEY_OF_NATIVE_NAME = 5;

	private $assocArray = [
		self::NAME_OF_639_1 => self::KEY_OF_639_1,
		self::NAME_OF_639_2t => self::KEY_OF_639_2t,
		self::NAME_OF_639_2b => self::KEY_OF_639_2b,
		self::NAME_OF_639_3 => self::KEY_OF_639_3,
		self::ISO_NAME => self::KEY_OF_ISO_NAME,
		self::NATIVE_NAME => self::KEY_OF_NATIVE_NAME
	];

	private $exceptionMessage = 'No data for this language';

	public function __construct()
	{
		$this->getStore();
		$this->getFileName();
		$this->updateLanguages();
	}

	/**
	 * @param string $from - name of input standard name (see useful consts of this class)
	 * @param string $to - name of output standard name (see useful consts of this class)
	 * @param string $codeOrName - standard code, native or ISO language name
	 * @return mixed
	 */
	public function convertCode(string $from, string $to, string $codeOrName): string
	{
		if (!isset($this->assocArray[$from]) || !isset($this->assocArray[$to]))
			throw new OutOfBoundsException($this->exceptionMessage);

		$arrayWithKeys = $this->getArrayWithRequiredKeys($this->assocArray[$from]);

		if (!isset($arrayWithKeys[$codeOrName]) || !isset($arrayWithKeys[$codeOrName][$this->assocArray[$to]]))
			throw new OutOfBoundsException($this->exceptionMessage);

		$result = $arrayWithKeys[$codeOrName][$this->assocArray[$to]];

		return $result;


	}

	/**
	 * @param int $index
	 * @return array
	 *
	 */
	private function getArrayWithRequiredKeys(int $index): array
	{
		if (!isset($this->languages[$index]))
			throw new OutOfBoundsException($this->exceptionMessage);

		$result = array_column($this->languages, null, $index);

		return $result;
	}

	private function getStore()
	{
		if (!isset($this->store)) {
			$this->store = new Store($this->format);
		}
		return $this->store;
	}

	private function getFileName()
	{
		$this->fileName = Yii::getAlias('@vendor/wooppay/php-iso-639-converter/src/res');
	}

	public function updateLanguages()
	{
		$store = $this->getStore();
		$this->languages = $store->load($this->fileName);
	}
}
